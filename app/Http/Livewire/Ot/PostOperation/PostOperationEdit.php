<?php

namespace App\Http\Livewire\Ot\PostOperation;

use App\Models\OtPostOperation;
use App\Models\OtPostOperationAttendant;
use App\Models\OtPostOperationNote;
use App\Models\OtPostOperationSampleCollectionNote;
use App\Models\OtPostOperationSurgeonNote;
use App\Models\OtPostOperationUnitRecord;
use App\Models\OtPreOperation;
use App\Models\OtType;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Traits\OtAttendantUpdate;
use Carbon\Carbon;
use Livewire\Component;

class PostOperationEdit extends Component
{
    use OtAttendantUpdate;

    public $ot_post_operation_id, $ot_pre_operation_id, $ot_booking_id, $post_operation_no, $post_operation_date, $status = "Not Approved";
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $pre_operartion_no, $pre_operartion_date, $ot_booking_no, $ot_booking_date, $service_id, $service_code, $surgery_type_id, $surgery_type_code, $surgery_date;
    public $duration, $ot_start_time, $ot_end_time, $ot_type_id, $ot_type_code, $blood_loss, $sent_to_icu;

    public $findings, $surgeon_notes;
    public $oper_notes, $sample_collection;

    public $pulse_rate_in, $pulse_rate_15, $pulse_rate_30, $pulse_rate_45, $pulse_rate_60, $pulse_rate_75, $pulse_rate_90, $pulse_rate_105, $pulse_rate_120;
    public $bp_in, $bp_15, $bp_30, $bp_45, $bp_60, $bp_75, $bp_90, $bp_105, $bp_120;
    public $rr_in, $rr_15, $rr_30, $rr_45, $rr_60, $rr_75, $rr_90, $rr_105, $rr_120;
    public $spo2_in, $spo2_15, $spo2_30, $spo2_45, $spo2_60, $spo2_75, $spo2_90, $spo2_105, $spo2_120;
    public $pain_score_in, $pain_score_15, $pain_score_30, $pain_score_45, $pain_score_60, $pain_score_75, $pain_score_90, $pain_score_105, $pain_score_120;

    public $pre_op_diagnosis, $post_op_diagnosis, $procedure_planned, $procedure_performed, $surgeon, $anesthesiologist, $asst_surgeon, $staff_nurses, $freop_antibiotic, $on_blood_loss, $blood_transfusion;
    public $incision, $on_findings, $procedure, $closure, $post_op_instruction, $specimens_sent;

    public $activeTab = 'surgery-details';

    public $patients = [];
    public $services = [];
    public $surgery_types = [];
    public $ot_types = [];

    public $arrCart = [];
    public $attendant_types = [];

    public function mount($id)
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
        $this->ot_types = OtType::where("is_active", "1")->get();


        $ot_post_operation = OtPostOperation::find($id);
        if ($ot_post_operation) {
            $this->ot_post_operation_id = $ot_post_operation->id;
            $this->post_operation_no = $ot_post_operation->code;
            $this->post_operation_date = date("Y-m-d H:i", strtotime($ot_post_operation->created_at));

            $this->ipd_id = $ot_post_operation->ipd_id;
            $this->patient_id = $ot_post_operation->patient_id;
            $this->umr = $ot_post_operation?->patient?->registration_no;

            $patient = Patient::where("registration_no", $this->umr)->first();
            if ($patient) {
                $this->patient_id = $patient->id;
                $this->patient_name = $patient?->name;
                $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
                $this->gender = $patient?->gender?->name;
                $this->patient_type = $patient?->patienttype?->name;

                $ipd = $patient->ipds()->where("id", $this->ipd_id)->latest()->first();
                $this->ipd_id = $ipd->id;
                $this->admn_no = $ipd->ipdcode;
                $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
                $this->ward = $ipd->ward?->name;
                $this->room = $ipd->room?->name;
                $this->bed = $ipd->bed?->display_name;

                $this->consultant_name = $ipd->patient_visit?->doctor?->name;
                $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
                $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            }

            $this->ot_pre_operation_id = $ot_post_operation->ot_pre_operation_id;
            $this->pre_operartion_no = $ot_post_operation?->ot_pre_operation?->code;
            $this->pre_operartion_date = date("Y-m-d H:i", strtotime($ot_post_operation?->ot_pre_operation?->created_at));

            $this->ot_booking_id = $ot_post_operation->ot_booking_id;
            $this->ot_booking_no = $ot_post_operation?->ot_booking?->code;
            $this->ot_booking_date = date("Y-m-d H:i", strtotime($ot_post_operation?->ot_booking?->created_at));

            $this->service_id = $ot_post_operation->service_id;
            $this->serviceChanged();
            $this->surgery_type_id = $ot_post_operation->surgery_type_id;
            $this->surgeryTypeChanged();
            $this->surgery_date = date("Y-m-d", strtotime($ot_post_operation->surgery_date));
            $this->duration = $ot_post_operation->duration;
            $this->ot_start_time = date("Y-m-d H:i", strtotime($ot_post_operation->ot_start_time));
            $this->ot_end_time = date("Y-m-d H:i", strtotime($ot_post_operation->ot_end_time));
            $this->ot_type_id = $ot_post_operation->ot_type_id;
            $this->otTypeChanged();
            $this->blood_loss = $ot_post_operation->blood_loss;
            $this->sent_to_icu = $ot_post_operation->sent_to_icu;

            $this->ot_post_operation_attendant_init($ot_post_operation);

            $surgeon_note = $ot_post_operation?->surgeon_note;
            $this->findings = $surgeon_note?->findings;
            $this->surgeon_notes = $surgeon_note?->surgeon_notes;

            $sample_collection_note = $ot_post_operation?->sample_collection_note;
            $this->oper_notes = $sample_collection_note?->oper_notes;
            $this->sample_collection = $sample_collection_note?->sample_collection;

            $unit_record = $ot_post_operation?->unit_record;
            $this->pulse_rate_in = $unit_record?->pulse_rate_in;
            $this->pulse_rate_15 = $unit_record?->pulse_rate_15;
            $this->pulse_rate_30 = $unit_record?->pulse_rate_30;
            $this->pulse_rate_45 = $unit_record?->pulse_rate_45;
            $this->pulse_rate_60 = $unit_record?->pulse_rate_60;
            $this->pulse_rate_75 = $unit_record?->pulse_rate_75;
            $this->pulse_rate_90 = $unit_record?->pulse_rate_90;
            $this->pulse_rate_105 = $unit_record?->pulse_rate_105;
            $this->pulse_rate_120 = $unit_record?->pulse_rate_120;

            $this->bp_in = $unit_record?->bp_in;
            $this->bp_15 = $unit_record?->bp_15;
            $this->bp_30 = $unit_record?->bp_30;
            $this->bp_45 = $unit_record?->bp_45;
            $this->bp_60 = $unit_record?->bp_60;
            $this->bp_75 = $unit_record?->bp_75;
            $this->bp_90 = $unit_record?->bp_90;
            $this->bp_105 = $unit_record?->bp_105;
            $this->bp_120 = $unit_record?->bp_120;

            $this->rr_in = $unit_record?->rr_in;
            $this->rr_15 = $unit_record?->rr_15;
            $this->rr_30 = $unit_record?->rr_30;
            $this->rr_45 = $unit_record?->rr_45;
            $this->rr_60 = $unit_record?->rr_60;
            $this->rr_75 = $unit_record?->rr_75;
            $this->rr_90 = $unit_record?->rr_90;
            $this->rr_105 = $unit_record?->rr_105;
            $this->rr_120 = $unit_record?->rr_120;

            $this->spo2_in = $unit_record?->spo2_in;
            $this->spo2_15 = $unit_record?->spo2_15;
            $this->spo2_30 = $unit_record?->spo2_30;
            $this->spo2_45 = $unit_record?->spo2_45;
            $this->spo2_60 = $unit_record?->spo2_60;
            $this->spo2_75 = $unit_record?->spo2_75;
            $this->spo2_90 = $unit_record?->spo2_90;
            $this->spo2_105 = $unit_record?->spo2_105;
            $this->spo2_120 = $unit_record?->spo2_120;

            $this->pain_score_in = $unit_record?->pain_score_in;
            $this->pain_score_15 = $unit_record?->pain_score_15;
            $this->pain_score_30 = $unit_record?->pain_score_30;
            $this->pain_score_45 = $unit_record?->pain_score_45;
            $this->pain_score_60 = $unit_record?->pain_score_60;
            $this->pain_score_75 = $unit_record?->pain_score_75;
            $this->pain_score_90 = $unit_record?->pain_score_90;
            $this->pain_score_105 = $unit_record?->pain_score_105;
            $this->pain_score_120 = $unit_record?->pain_score_120;

            $operation_note = $ot_post_operation?->operation_note;
            $this->pre_op_diagnosis = $operation_note?->pre_op_diagnosis;
            $this->post_op_diagnosis = $operation_note?->post_op_diagnosis;
            $this->procedure_planned = $operation_note?->procedure_planned;
            $this->procedure_performed = $operation_note?->procedure_performed;
            $this->surgeon = $operation_note?->surgeon;
            $this->anesthesiologist = $operation_note?->anesthesiologist;
            $this->asst_surgeon = $operation_note?->asst_surgeon;
            $this->staff_nurses = $operation_note?->staff_nurses;
            $this->freop_antibiotic = $operation_note?->freop_antibiotic;
            $this->on_blood_loss = $operation_note?->blood_loss;
            $this->blood_transfusion = $operation_note?->blood_transfusion;
            $this->incision = $operation_note?->incision;
            $this->on_findings = $operation_note?->findings;
            $this->procedure = $operation_note?->procedure;
            $this->closure = $operation_note?->closure;
            $this->post_op_instruction = $operation_note?->post_op_instruction;
            $this->specimens_sent = $operation_note?->specimens_sent;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;

            $this->consultant_name = $ipd->patient_visit?->doctor?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;

            $pre_operartion = OtPreOperation::where("ipd_id", $this->ipd_id)->where("patient_id", $this->patient_id)->latest()->first();
            if ($pre_operartion) {
                $this->ot_pre_operation_id = $pre_operartion->id;
                $this->pre_operartion_no = $pre_operartion->code;
                $this->pre_operartion_date = date("Y-m-d H:i", strtotime($pre_operartion->created_at));
                $this->ot_booking_id = $pre_operartion?->ot_booking?->id;
                $this->ot_booking_no = $pre_operartion?->ot_booking?->code;
                $this->ot_booking_date = date("Y-m-d H:i", strtotime($pre_operartion?->ot_booking?->created_at));
                $this->service_id = $pre_operartion->service_id;
                $this->service_code = $pre_operartion?->service?->code;
                $this->surgery_type_id = $pre_operartion->surgery_type_id;
                $this->surgery_type_code = $pre_operartion->surgery_type?->code;
                $this->surgery_date = date("Y-m-d", strtotime($pre_operartion->surgery_date));
                $this->duration = $pre_operartion->duration;
                $this->ot_start_time = date("Y-m-d H:i", strtotime($pre_operartion->ot_start_time));
                $this->ot_end_time = date("Y-m-d H:i", strtotime($pre_operartion->estimated_time));
                $this->ot_type_id = $pre_operartion->ot_type_id;
                $this->ot_type_code = $pre_operartion->ot_type?->code;

                $this->ot_pre_operation_attendant_init($pre_operartion);
            } else {
                $this->ot_pre_operation_id = null;
                $this->pre_operartion_no = null;
                $this->pre_operartion_date = null;
                $this->ot_booking_no = null;
                $this->ot_booking_date = null;
                $this->service_id = null;
                $this->service_code = null;
                $this->surgery_type_id = null;
                $this->surgery_type_code = null;
                $this->surgery_date = null;
                $this->duration = null;
                $this->ot_start_time = null;
                $this->ot_end_time = null;
                $this->ot_type_id = null;
                $this->ot_type_code = null;

                $this->arrCart = [];
                $this->addRow();
            }
        }
    }

    public function serviceChanged()
    {
        $service = Service::find($this->service_id);
        if ($service) {
            $this->service_code = $service->code;
        }
    }

    public function surgeryTypeChanged()
    {
        $surgeryType = SurgeryType::find($this->surgery_type_id);
        if ($surgeryType) {
            $this->surgery_type_code = $surgeryType->code;
        }
    }

    public function otTypeChanged()
    {
        $otType = OtType::find($this->ot_type_id);
        if ($otType) {
            $this->ot_type_code = $otType->code;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function rules()
    {
        return [
            "ot_booking_id" => "required",
            "ot_pre_operation_id" => "required",
            'umr' => 'required',
            'patient_id' => 'required',
            'admn_no' => 'required',
            'ipd_id' => 'required',
            'ot_type_id' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $ot_post_operation = OtPostOperation::find($this->ot_post_operation_id);
        if ($ot_post_operation) {
            $ot_post_operation->update([
                "ot_booking_id" => $this->ot_booking_id,
                "ot_pre_operation_id" => $this->ot_pre_operation_id,
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                "service_id" => $this->service_id,
                "surgery_type_id" => $this->surgery_type_id,
                "surgery_date" => date("Y-m-d", strtotime($this->surgery_date)),
                "duration" => $this->duration,
                "ot_start_time" => date("Y-m-d H:i:s", strtotime($this->ot_start_time)),
                "ot_end_time" => date("Y-m-d H:i:s", strtotime($this->ot_end_time)),
                "ot_type_id" => $this->ot_type_id,
                "blood_loss" => $this->blood_loss,
                "sent_to_icu" => $this->sent_to_icu ? 1 : 0,
            ]);

            OtPostOperationAttendant::where("ot_post_operation_id", $this->ot_post_operation_id)->delete();

            foreach ($this->arrCart as $attendant) {
                if (!empty($attendant['attendant_name']) && !empty($attendant['attendant_type']) && !empty($attendant['attendant_id'])) {
                    OtPostOperationAttendant::create([
                        'name' => $attendant['attendant_name'],
                        'attendant_type' => $attendant['attendant_type'],
                        'attendant_id' => $attendant['attendant_id'],
                        'ot_post_operation_id' => $this->ot_post_operation_id,
                    ]);
                }
            }
            OtPostOperationSurgeonNote::where("ot_post_operation_id", $this->ot_post_operation_id)->update([
                'findings' => $this->findings,
                'surgeon_notes' => $this->surgeon_notes,
            ]);

            OtPostOperationSampleCollectionNote::where("ot_post_operation_id", $this->ot_post_operation_id)->update([
                'oper_notes' => $this->oper_notes,
                'sample_collection' => $this->sample_collection,
            ]);

            OtPostOperationUnitRecord::where("ot_post_operation_id", $this->ot_post_operation_id)->update([
                'pulse_rate_in' => $this->pulse_rate_in,
                'pulse_rate_15' => $this->pulse_rate_15,
                'pulse_rate_30' => $this->pulse_rate_30,
                'pulse_rate_45' => $this->pulse_rate_45,
                'pulse_rate_60' => $this->pulse_rate_60,
                'pulse_rate_75' => $this->pulse_rate_75,
                'pulse_rate_90' => $this->pulse_rate_90,
                'pulse_rate_105' => $this->pulse_rate_105,
                'pulse_rate_120' => $this->pulse_rate_120,

                'bp_in' => $this->bp_in,
                'bp_15' => $this->bp_15,
                'bp_30' => $this->bp_30,
                'bp_45' => $this->bp_45,
                'bp_60' => $this->bp_60,
                'bp_75' => $this->bp_75,
                'bp_90' => $this->bp_90,
                'bp_105' => $this->bp_105,
                'bp_120' => $this->bp_120,

                'rr_in' => $this->rr_in,
                'rr_15' => $this->rr_15,
                'rr_30' => $this->rr_30,
                'rr_45' => $this->rr_45,
                'rr_60' => $this->rr_60,
                'rr_75' => $this->rr_75,
                'rr_90' => $this->rr_90,
                'rr_105' => $this->rr_105,
                'rr_120' => $this->rr_120,

                'spo2_in' => $this->spo2_in,
                'spo2_15' => $this->spo2_15,
                'spo2_30' => $this->spo2_30,
                'spo2_45' => $this->spo2_45,
                'spo2_60' => $this->spo2_60,
                'spo2_75' => $this->spo2_75,
                'spo2_90' => $this->spo2_90,
                'spo2_105' => $this->spo2_105,
                'spo2_120' => $this->spo2_120,

                'pain_score_in' => $this->pain_score_in,
                'pain_score_15' => $this->pain_score_15,
                'pain_score_30' => $this->pain_score_30,
                'pain_score_45' => $this->pain_score_45,
                'pain_score_60' => $this->pain_score_60,
                'pain_score_75' => $this->pain_score_75,
                'pain_score_90' => $this->pain_score_90,
                'pain_score_105' => $this->pain_score_105,
                'pain_score_120' => $this->pain_score_120,
            ]);

            OtPostOperationNote::where("ot_post_operation_id", $this->ot_post_operation_id)->update([
                'pre_op_diagnosis' => $this->pre_op_diagnosis,
                'post_op_diagnosis' => $this->post_op_diagnosis,
                'procedure_planned' => $this->procedure_planned,
                'procedure_performed' => $this->procedure_performed,
                'surgeon' => $this->surgeon,
                'anesthesiologist' => $this->anesthesiologist,
                'asst_surgeon' => $this->asst_surgeon,
                'staff_nurses' => $this->staff_nurses,
                'freop_antibiotic' => $this->freop_antibiotic,
                'blood_loss' => $this->on_blood_loss,
                'blood_transfusion' => $this->blood_transfusion,

                'incision' => $this->incision,
                'findings' => $this->on_findings,
                'procedure' => $this->procedure,
                'closure' => $this->closure,
                'post_op_instruction' => $this->post_op_instruction,
                'specimens_sent' => $this->specimens_sent,
            ]);

            session()->flash('message', 'Post Operation Updated Successfully.');
            return redirect()->route('admin.ot.post-operation');
        }

        session()->flash('error', 'Something went wrong.');
    }
    public function render()
    {
        return view('livewire.ot.post-operation.post-operation-edit')->extends('layouts.admin')->section('content');
    }
}

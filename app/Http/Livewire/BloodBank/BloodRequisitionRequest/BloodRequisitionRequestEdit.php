<?php

namespace App\Http\Livewire\BloodBank\BloodRequisitionRequest;

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
use App\Models\BloodRequisitionRequestSampleBloodGroup;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Title;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BloodRequisitionRequestEdit extends Component
{
    public $blood_requisition_request_id, $type = "in-patient", $requisition_req_no, $requisition_req_date, $status = "Not Approved";
    public $out_side_patient_id, $title_id, $gender_id, $mobile, $address;
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $bloodgroup_id, $doctor_id, $doctor_code;

    public $whole_blood, $ffp, $hb, $pt, $prbc, $epp, $pulse, $ptt, $pu, $cryoprecipitate, $bp, $pvu_level, $ldrbc, $onrbc_ab_plasma, $weight, $s_albumin, $pc, $onrbc_ab_plasma_2, $reason_for_over_ride;

    public $blood_groups = [];
    public $titles = [];
    public $genders = [];
    public $patients = [];
    public $ipds = [];
    public $doctors = [];

    public $received_sample_blood_group_date;
    public $sample_blood_groups = [];

    public function mount($id)
    {
        $this->blood_groups = Bloodgroup::get();
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->doctors = Doctor::latest()->get();

        $blood_requisition_request = BloodRequisitionRequest::find($id);

        if ($blood_requisition_request) {
            $this->blood_requisition_request_id = $blood_requisition_request->id;
            $this->type = $blood_requisition_request->type;
            $this->requisition_req_no = $blood_requisition_request->code;
            $this->requisition_req_date = date("Y-m-d H:i", strtotime($blood_requisition_request->created_at));

            if ($this->type == "in-patient") {
                $this->ipd_id = $blood_requisition_request->ipd_id;
                $this->ipdChanged();
            }

            if ($this->type == "out-patient") {
                $this->patient_id = $blood_requisition_request->patient_id;
                $this->umr = $blood_requisition_request?->patient?->registration_no;
                $this->umrChanged();
            }

            if ($this->type == "outside-patient") {
                $this->out_side_patient_id = $blood_requisition_request->out_side_patient_id;
                $this->patient_name = $blood_requisition_request?->out_side_patient?->name;
                $this->mobile = $blood_requisition_request?->out_side_patient?->mobile;
                $this->age = $blood_requisition_request?->out_side_patient?->age;
                $this->address = $blood_requisition_request?->out_side_patient?->address;
                $this->title_id = $blood_requisition_request?->out_side_patient?->title_id;
                $this->gender_id = $blood_requisition_request?->out_side_patient?->gender_id;
            }


            $this->bloodgroup_id = $blood_requisition_request->bloodgroup_id;
            $this->doctor_id = $blood_requisition_request->doctor_id;
            $this->doctorChanged();
            $this->whole_blood = $blood_requisition_request->whole_blood;
            $this->ffp = $blood_requisition_request->ffp;
            $this->hb = $blood_requisition_request->hb;
            $this->pt = $blood_requisition_request->pt;
            $this->prbc = $blood_requisition_request->prbc;
            $this->epp = $blood_requisition_request->epp;
            $this->pulse = $blood_requisition_request->pulse;
            $this->ptt = $blood_requisition_request->ptt;
            $this->pu = $blood_requisition_request->pu;
            $this->cryoprecipitate = $blood_requisition_request->cryoprecipitate;
            $this->bp = $blood_requisition_request->bp;
            $this->pvu_level = $blood_requisition_request->pvu_level;
            $this->ldrbc = $blood_requisition_request->ldrbc;
            $this->onrbc_ab_plasma = $blood_requisition_request->onrbc_ab_plasma;
            $this->weight = $blood_requisition_request->weight;
            $this->s_albumin = $blood_requisition_request->s_albumin;
            $this->pc = $blood_requisition_request->pc;
            $this->onrbc_ab_plasma_2 = $blood_requisition_request->onrbc_ab_plasma_2;
            $this->reason_for_over_ride = $blood_requisition_request->reason_for_over_ride;
            $this->status = $blood_requisition_request->status;

            $this->received_sample_blood_group_date = date("Y-m-d H:i");

            if ($blood_requisition_request->sample_blood_groups()->count() > 0) {
                $this->sample_blood_groups = [];

                foreach ($blood_requisition_request->sample_blood_groups as $sample_blood_group) {
                    $this->sample_blood_groups[] = array(
                        "blood_unit_no" => $sample_blood_group->blood_unit_no,
                        "bloodgroup_list" => Bloodgroup::get(),
                        "bloodgroup_id" => $sample_blood_group->bloodgroup_id,
                        "component" => $sample_blood_group->component,
                        "date_time_issued" => date("Y-m-d H:i", strtotime($sample_blood_group->date_time_issued)),
                        "issued_by" => $sample_blood_group->issued_by,
                        "received_by" => $sample_blood_group->received_by,
                    );
                }
            } else {
                $this->addRow();
            }
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_name = $ipd?->patient?->name;
            $this->title_id = $ipd?->patient?->title_id;
            $this->gender_id = $ipd?->patient?->gender_id;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $ipd?->patient?->gender?->name;
            $this->patient_type = $ipd?->patient?->patienttype?->name;

            $this->admn_no = $ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->consultant_name = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->title_id = $patient->title_id;
            $this->gender_id = $patient->gender_id;
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
        }
    }

    public function doctorChanged()
    {
        $doctor = Doctor::find($this->doctor_id);
        if ($doctor) {
            $this->doctor_code = $doctor->code;
        }
    }

    public function rules()
    {
        $rules = [
            'patient_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'ipd_id' => 'required_if:type,in-patient',
            'umr' => 'required_if:type,out-patient',
            'title_id' => 'required_if:type,outside-patient',
            'gender_id' => 'required_if:type,outside-patient',
            'bloodgroup_id' => 'required',
            'doctor_id' => 'required',
            'doctor_code' => 'required',
        ];

        if (in_array($this->type, ['in-patient', 'out-patient'])) {
            $rules['patient_id'] = 'required';
        }

        return $rules;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function addRow()
    {
        $this->sample_blood_groups[] = array(
            "blood_unit_no" => "",
            "bloodgroup_list" => Bloodgroup::get(),
            "bloodgroup_id" => "",
            "component" => "",
            "date_time_issued" => date("Y-m-d H:i"),
            "issued_by" => "",
            "received_by" => "",
        );
    }

    public function removeRow($index)
    {
        if (count($this->sample_blood_groups) == 1) {
            session()->flash('error', 'At least one row is required.');
            return;
        }

        unset($this->sample_blood_groups[$index]);
    }

    public function save()
    {
        $this->validate();

        if ($this->type == 'outside-patient') {
            $out_side_patient = OutSidePatient::find($this->out_side_patient_id);
            if ($out_side_patient) {
                $out_side_patient->update([
                    'name' => $this->patient_name,
                    'mobile' => $this->mobile,
                    'age' => $this->age,
                    'address' => $this->address,
                    'title_id' => $this->title_id,
                    'gender_id' => $this->gender_id,
                ]);
            }
        }

        $blood_requisition_request = BloodRequisitionRequest::find($this->blood_requisition_request_id);
        if ($blood_requisition_request) {
            $blood_requisition_request->update([
                'bloodgroup_id' => $this->bloodgroup_id,
                'doctor_id' => $this->doctor_id,
                'whole_blood' => $this->whole_blood,
                'ffp' => $this->ffp,
                'hb' => $this->hb,
                'pt' => $this->pt,
                'prbc' => $this->prbc,
                'epp' => $this->epp,
                'pulse' => $this->pulse,
                'ptt' => $this->ptt,
                'pu' => $this->pu,
                'cryoprecipitate' => $this->cryoprecipitate,
                'bp' => $this->bp,
                'pvu_level' => $this->pvu_level,
                'ldrbc' => $this->ldrbc,
                'onrbc_ab_plasma' => $this->onrbc_ab_plasma,
                'weight' => $this->weight,
                's_albumin' => $this->s_albumin,
                'pc' => $this->pc,
                'onrbc_ab_plasma_2' => $this->onrbc_ab_plasma_2,
                'reason_for_over_ride' => $this->reason_for_over_ride,
                'status' => $this->status,
            ]);

            $blood_requisition_request->update([
                'status' => 'Approved',
                'updated_by_id' => auth()->user()?->id,
            ]);

            BloodRequisitionRequestSampleBloodGroup::where('blood_requisition_request_id', $this->blood_requisition_request_id)->forceDelete();

            foreach ($this->sample_blood_groups as $sample_blood_group) {
                if (!empty($sample_blood_group['blood_unit_no']) || !empty($sample_blood_group['bloodgroup_id']) || !empty($sample_blood_group['component']) || !empty($sample_blood_group['issued_by']) || !empty($sample_blood_group['received_by'])) {
                    BloodRequisitionRequestSampleBloodGroup::create([
                        'blood_requisition_request_id' => $this->blood_requisition_request_id,
                        'blood_unit_no' => $sample_blood_group['blood_unit_no'],
                        'bloodgroup_id' => $sample_blood_group['bloodgroup_id'],
                        'component' => $sample_blood_group['component'],
                        'date_time_issued' => date("Y-m-d H:i", strtotime($sample_blood_group['date_time_issued'])),
                        'issued_by' => $sample_blood_group['issued_by'],
                        'received_by' => $sample_blood_group['received_by'],
                        'created_by_id' => auth()->user()?->id,
                    ]);
                }
            }

            session()->flash('message', 'Blood Requisition Request Updated Successfully.');
            return redirect()->route('admin.blood-requisition-request');
        }

        session()->flash('error', 'Blood Requisition Request Not Found.');
    }
    public function render()
    {
        return view('livewire.blood-bank.blood-requisition-request.blood-requisition-request-edit')->extends('layouts.admin')->section('content');
    }
}

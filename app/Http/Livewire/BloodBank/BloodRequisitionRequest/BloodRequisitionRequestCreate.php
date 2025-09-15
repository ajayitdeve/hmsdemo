<?php

namespace App\Http\Livewire\BloodBank\BloodRequisitionRequest;

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Title;
use Carbon\Carbon;
use Livewire\Component;

class BloodRequisitionRequestCreate extends Component
{
    public $type = "in-patient", $requisition_req_no, $requisition_req_date, $status = "Not Approved";
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

    public function mount()
    {
        $this->generate_code();
        $this->blood_groups = Bloodgroup::get();
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->doctors = Doctor::latest()->get();
    }

    public function generate_code()
    {
        $this->requisition_req_no = "BRQ" . BloodRequisitionRequest::max('id') + 1;
        $this->requisition_req_date = date("Y-m-d H:i");
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

    public function save()
    {
        $this->validate();

        if ($this->type == 'outside-patient') {
            $ospMaxId = OutSidePatient::max('id');
            $ospCode = 'OSD' . date('y') . date('m') . date('d') . $ospMaxId + 1;

            $out_side_patient = OutSidePatient::create([
                'registration_no' => $ospCode,
                'name' => $this->patient_name,
                'mobile' => $this->mobile,
                'age' => $this->age,
                'address' => $this->address,
                'title_id' => $this->title_id,
                'gender_id' => $this->gender_id,
                'created_by_id' => auth()->user()?->id,
            ]);

            $this->out_side_patient_id = $out_side_patient?->id;
        }

        BloodRequisitionRequest::create([
            'ipd_id' => $this->ipd_id,
            'patient_id' => $this->patient_id,
            'code' => $this->requisition_req_no,
            'type' => $this->type,
            'out_side_patient_id' => $this->out_side_patient_id,
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
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Blood Requisition Request Added Successfully.');
        return redirect()->route('admin.blood-requisition-request');
    }

    public function render()
    {
        return view('livewire.blood-bank.blood-requisition-request.blood-requisition-request-create')->extends('layouts.admin')->section('content');
    }
}

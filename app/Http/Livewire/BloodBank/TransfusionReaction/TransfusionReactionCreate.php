<?php

namespace App\Http\Livewire\BloodBank\TransfusionReaction;

use App\Models\Bloodgroup;
use App\Models\BloodRequisitionRequest;
use App\Models\CostCenter;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Title;
use App\Models\TransfusionReaction;
use Carbon\Carbon;
use Livewire\Component;

class TransfusionReactionCreate extends Component
{
    public $type = "in-patient", $patient_id, $umr, $title_id, $patient_name, $age, $gender_id, $ipd_id, $admn_no, $mobile, $address, $out_side_patient_id;
    public $ward, $room, $bed, $corporate_code, $corporate_name, $cost_center_id, $blood_requisition_request_id;
    public $transfusion_no, $date_of_issue, $name_of_uc, $bloodgroup_id, $compatible_with_unit_no, $date_of_collection, $date_of_expiry;
    public $date_of_supply, $time_of_supply, $remarks_for_blood_bank;

    public $titles = [];
    public $genders = [];
    public $patients = [];
    public $ipds = [];
    public $cost_centers = [];
    public $blood_groups = [];
    public $blood_requisitions = [];

    public function mount()
    {
        $this->generate_code();

        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->cost_centers = CostCenter::get();
        $this->blood_groups = Bloodgroup::get();
        $this->blood_requisitions = BloodRequisitionRequest::latest()->get();

        $this->cost_center_id = CostCenter::first()?->id;
    }

    public function generate_code()
    {
        $this->transfusion_no = "TR" . TransfusionReaction::max('id') + 1;
        $this->date_of_issue = date("Y-m-d H:i");
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
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y');
            $this->admn_no = $ipd?->ipdcode;

            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

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
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y');

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;

            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;

            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function bloodRequisitionRequestChanged()
    {
        $blood_requisition_request = BloodRequisitionRequest::find($this->blood_requisition_request_id);
        if ($blood_requisition_request) {
            $this->bloodgroup_id = $blood_requisition_request->bloodgroup_id;

            if ($blood_requisition_request->ipd_id) {
                $this->ipd_id = $blood_requisition_request->ipd_id;
                $this->ipdChanged();
            }
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function rules()
    {
        return [
            'patient_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'title_id' => 'required_if:type,outside-patient',
            'gender_id' => 'required_if:type,outside-patient',
            'cost_center_id' => 'required',
            'name_of_uc' => 'nullable|string|max:100',
            'transfusion_no' => 'required',
            'date_of_issue' => 'nullable|date',
            'compatible_with_unit_no' => 'nullable|string|max:100',
            'date_of_collection' => 'nullable|date',
            'date_of_expiry' => 'nullable|date',
            'date_of_supply' => 'nullable|date',
            'time_of_supply' => 'nullable|date_format:H:i',
            'bloodgroup_id' => 'required',
        ];
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

            $this->out_side_patient_id = $out_side_patient->id;
        }

        TransfusionReaction::create([
            'ipd_id' => $this->ipd_id ?? null,
            'patient_id' => $this->patient_id ?? null,
            'type' => $this->type,
            'out_side_patient_id' => $this->out_side_patient_id,
            'blood_requisition_request_id' => $this->blood_requisition_request_id ?? null,
            'cost_center_id' => $this->cost_center_id ?? null,
            'code' => $this->transfusion_no,
            'date_of_issue' => $this->date_of_issue ? date("Y-m-d H:i:s", strtotime($this->date_of_issue)) : null,
            'name_of_uc' => $this->name_of_uc ?? null,
            'bloodgroup_id' => $this->bloodgroup_id ?? null,
            'compatible_with_unit_no' => $this->compatible_with_unit_no ?? null,
            'date_of_collection' => $this->date_of_collection ? date("Y-m-d", strtotime($this->date_of_collection)) : null,
            'date_of_expiry' => $this->date_of_expiry ? date("Y-m-d", strtotime($this->date_of_expiry)) : null,
            'date_of_supply' => $this->date_of_supply ? date("Y-m-d", strtotime($this->date_of_supply)) : null,
            'time_of_supply' => $this->time_of_supply ? date("H:i:s", strtotime($this->time_of_supply)) : null,
            'remarks_for_blood_bank' => $this->remarks_for_blood_bank ?? null,
            'status' => 0,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Transfusion Reaction Added Successfully.');
        return redirect()->route('admin.transfusion-reaction');
    }

    public function render()
    {
        return view('livewire.blood-bank.transfusion-reaction.transfusion-reaction-create')->extends('layouts.admin')->section('content');
    }
}

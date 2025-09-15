<?php

namespace App\Http\Livewire\FrontDesk\Adt\InPatientCreditLimit;

use App\Models\Ipd\Ipd;
use App\Models\Ipd\Organization;
use App\Models\Patient;
use App\Models\PatientCreditLimit;
use App\Models\Wallet;
use Carbon\Carbon;
use Livewire\Component;

class InpatientCreditLimit extends Component
{
    public $ipd, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_date, $ward, $room, $bed;
    public $credit_limit, $authrization_by, $authrization_code, $remarks;

    public $patients = [];
    public $ipds = [];
    public $organizations = [];
    public $patient_credits = [];

    public function mount()
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->organizations = Organization::get();
    }

    public function rules()
    {
        return [
            "umr" => "required",
            "patient_name" => "required",
            "ipd_id" => "required",
            "credit_limit" => "required",
            "authrization_by" => "required",
            "authrization_code" => "required",
        ];
    }

    public function getPatientCredit()
    {
        $this->patient_credits = PatientCreditLimit::where("patient_id", $this->ipd?->patient_id)
            ->where("ipd_id", $this->ipd?->id)
            ->latest()
            ->get();
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->ipd = $ipd;

            $patient = $ipd?->patient;
            $this->umr = $ipd?->patient?->registration_no;

            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;
            $this->ipd_id = $ipd?->id;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->getPatientCredit();
        }
    }

    public function umrChanged()
    {
        $patient = Patient::with(["ipds"])->where("registration_no", $this->umr)->whereHas("ipds")->first();
        if ($patient) {
            $ipd = $patient->ipds()->latest()->first();
            $this->ipd = $ipd;

            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;
            $this->ipd_id = $ipd?->id;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->getPatientCredit();
        }
    }

    public function authrizationChanged()
    {
        $organization = Organization::find($this->authrization_by);
        if ($organization) {
            $this->authrization_code = $organization->code;
        }
    }

    public function save()
    {
        $this->validate();

        PatientCreditLimit::create([
            "patient_id" => $this->ipd?->patient_id,
            "ipd_id" => $this->ipd?->id,
            "credit_limit" => $this->credit_limit,
            "authrization_by" => $this->authrization_by,
            "remarks" => $this->remarks,
            "created_by_id" => auth()->user()?->id,
        ]);

        $total_credit_limit = PatientCreditLimit::where("patient_id", $this->ipd?->patient_id)
            ->where("ipd_id", $this->ipd?->id)
            ->sum("credit_limit");

        $wallet =  Wallet::where("patient_id", $this->ipd?->patient_id)
            ->where("ipd_id", $this->ipd?->id)
            ->first();

        if ($wallet) {
            $wallet->credit_limit = ($wallet->credit_limit ?? 0) + $this->credit_limit;
            $wallet->total_credit_limit = $total_credit_limit;
            $wallet->save();
        }

        session()->flash("message", "Patient Credit Limit Added Successfully.");

        $this->reset(["credit_limit", "authrization_by", "authrization_code", "remarks"]);

        $this->getPatientCredit();
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function render()
    {
        return view('livewire.front-desk.adt.in-patient-credit-limit.inpatient-credit-limit')->extends('layouts.admin')->section('content');
    }
}

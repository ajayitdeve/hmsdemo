<?php

namespace App\Http\Livewire\Ipd\CorporateConsultation;

use App\Models\Doctor;
use App\Models\Ipd\CorporateConsultation as IpdCorporateConsultation;
use App\Models\Ipd\Organization;
use App\Models\Patient;
use App\Models\User;
use App\Models\VisitType;
use Carbon\Carbon;
use Livewire\Component;

class CorporateConsultation extends Component
{
    public $corporate_registration_id;
    public $organization_id, $organization_code, $type, $umr, $patient_id, $patient_name, $patient_type, $status, $age, $gender, $nationality;
    public $consultation_no, $consultation_datetime, $last_consultation_date, $payment_by, $patient_visit_id;
    public $ref_source, $ref_letter_no, $ref_letter_date, $employee_no, $visit_type_id, $consultant_id, $consultant_code, $consultant_fee, $chief_complaint, $remarks;

    public $visit_types = [];
    public $organizations = [];
    public $patients = [];
    public $doctors = [];
    public $users = [];

    public function mount()
    {
        $this->organizations = Organization::get();
        $this->visit_types = VisitType::get();
        $this->users = User::get();

        $this->type = "general";
        $this->status = "Not Approved";
        $this->consultation_no = $this->generateCode();
        $this->consultation_datetime = date("Y-m-d H:i");
        $this->last_consultation_date = date("Y-m-d");
        $this->payment_by = "Personal";
        $this->ref_source = "walking";
        $this->ref_letter_date = date("Y-m-d");
    }

    public function generateCode()
    {
        $count = 1;
        return "OP" . date("y") . date("m") . date("d") . $count + 1;
    }

    public function organizationChanged()
    {
        $organization = Organization::where('id', $this->organization_id)->first();
        if ($organization) {
            $this->organization_code = $organization->code;
            $this->patients = Patient::whereHas('corporate_registrations', function ($query) {
                $query->where('organization_id', $this->organization_id);
            })->latest()->get();

            $this->reset(["type", "umr", "patient_name", "patient_type", "age", "gender", "nationality", "payment_by", "ref_source", "ref_letter_no", "employee_no", "visit_type_id", "consultant_id", "consultant_code", "consultant_fee", "chief_complaint", "remarks"]);

            $this->mount();
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where('registration_no', $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient?->id;
            $this->patient_name = $patient?->name;
            $this->patient_type = $patient?->patienttype->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->nationality = $patient?->nationality?->name;
            $this->patient_visit_id = $patient?->patientvisits()->latest()->first()?->id;
            $this->visit_type_id = $patient?->patientvisits()->latest()->first()?->visit_type_id;

            $corporate_registration = $patient?->corporate_registrations()->where('organization_id', $this->organization_id)->latest()->first();
            if ($corporate_registration) {
                $this->corporate_registration_id = $corporate_registration?->id;
                $this->ref_letter_no = $corporate_registration?->referral_letter_no;
                $this->ref_letter_date = $corporate_registration?->referral_letter_date ? date("Y-m-d", strtotime($corporate_registration?->referral_letter_date)) : "";
                $this->employee_no = $corporate_registration?->employee_no;

                $this->doctors = Doctor::where('department_id', $corporate_registration->department_id)->latest()->get();

                if ($corporate_registration->corporate_consultation()->count() > 0) {
                    session()->flash("error", "Consultation already exists for this patient");
                }
            }
        }
    }

    public function consultantChanged()
    {
        $doctor = Doctor::where('id', $this->consultant_id)->first();
        if ($doctor) {
            $this->consultant_code = $doctor->code;
            $this->consultant_fee = $doctor->fee;
        }
    }

    public function save()
    {
        $this->validate([
            'corporate_registration_id' => 'required|unique:corporate_consultations,corporate_registration_id',
            'organization_id' => 'required',
            'umr' => 'required',
            'patient_id' => 'required',
            'type' => 'required',
            'consultation_no' => 'required',
            'visit_type_id' => 'required',
            'consultant_id' => 'required',
            'consultant_code' => 'required',
        ], [
            "corporate_registration_id.unique" => "Consultation already exists for this patient",
        ]);

        IpdCorporateConsultation::create([
            'corporate_registration_id' => $this->corporate_registration_id,
            'organization_id' => $this->organization_id,
            'patient_id' => $this->patient_id,
            'patient_visit_id' => $this->patient_visit_id,
            'code' => $this->generateCode(),
            'type' => $this->type,
            'payment_by' => $this->payment_by,
            'ref_source' => $this->ref_source,
            'visit_type_id' => $this->visit_type_id,
            'doctor_id' => $this->consultant_id,
            'chief_complaint' => $this->chief_complaint,
            'remarks' => $this->remarks,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Corporate consultation added successfully.');

        $this->reset(["corporate_registration_id", "organization_id", "organization_code", "type", "umr", "patient_id", "patient_name", "patient_type", "age", "gender", "nationality", "consultation_no", "consultation_datetime", "last_consultation_date", "payment_by", "ref_source", "ref_letter_no", "employee_no", "visit_type_id", "consultant_id", "consultant_code", "consultant_fee", "chief_complaint", "remarks"]);
        $this->mount();
    }

    public function render()
    {
        return view('livewire.ipd.corporate-consultation.corporate-consultation')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Ipd\CorporateRegistration;

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\DepartmentCorporateFee;
use App\Models\Doctor;
use App\Models\IdType;
use App\Models\Ipd\CorporateConsultation;
use App\Models\Ipd\CorporateRegistration as IpdCorporateRegistration;
use App\Models\Ipd\CorporateRelation;
use App\Models\Ipd\Organization;
use App\Models\Patient;
use App\Models\VisitType;
use App\Models\Unit;
use Livewire\Component;

class CorporateRegistration extends Component
{
    public $umr, $patient_name, $patient_age, $patient_gender, $patient_type, $employee_no, $employee_name, $employee_designation;
    public $id_type_id, $id_types = [];
    public $organization_id, $organization_code, $department_id, $unit_id, $cost_center_id, $relationship_to_emp = 'self', $corporate_relation_id;
    public $medical_card_no, $card_validity, $referral_letter_no, $referral_letter_date, $purpose, $payment_mode = 'cash', $letter_for = "OP", $tpa_name, $diagnosis, $letter_issued_by;

    public $patient, $organizations = [], $departments = [], $units = [], $costcenters = [], $corporate_relations = [];
    public  $patients = [];

    public $type, $consultation_no, $consultation_datetime, $payment_by, $patient_visit_id, $visit_type_id, $consultant_id, $consultant_code, $consultant_fee, $chief_complaint, $remarks;
    public $doctors = [];
    public $visit_types = [];
    public $department_name, $department_corporate_fee = 0;

    public function rules()
    {
        return [
            'umr' => 'required',
            'organization_id' => 'required',
            'medical_card_no' => 'required',
            'card_validity' => 'required',
            // 'corporate_relation_id' => 'required',
            'employee_no' => 'required',
            'employee_name' => 'required',
            'department_id' => 'required',
            'unit_id' => 'required',
            'cost_center_id' => 'required',
            'referral_letter_date' => 'required',
            'type' => 'required',
            'visit_type_id' => 'required',
            'consultation_no' => 'required',
            'patient_visit_id' => 'required',
            'consultant_id' => 'required',
            'consultant_code' => 'required',
            'department_corporate_fee' => 'required',
        ];
    }

    public function mount()
    {
        $this->patients = Patient::doesntHave("ipds")->latest()->get();

        $this->departments = Department::whereHas("department_fee", function ($query) {
            $query->where("is_active", 1);
        })->get();

        $this->organizations = Organization::get();
        $this->costcenters = CostCenter::get();
        $this->corporate_relations = CorporateRelation::all();
        $this->card_validity = date("Y-m-d");
        $this->referral_letter_date = date("Y-m-d");

        $this->visit_types = VisitType::get();
        $this->id_types = IdType::get();

        $this->cost_center_id = CostCenter::first()?->id;
        $this->type = "general";
        $this->consultation_no = $this->generateCode();
        $this->consultation_datetime = date("Y-m-d H:i");
        $this->payment_by = "Corporate";
    }

    public function generateCode()
    {
        $count = CorporateConsultation::max("id");
        return "OP" . date("y") . date("m") . date("d") . $count + 1;
    }

    public function department_corporate_fee()
    {
        $department_corporate_fee = DepartmentCorporateFee::where('department_id', $this->department_id)
            ->where('organization_id', $this->organization_id)
            ->first();

        if ($department_corporate_fee) {
            $this->department_corporate_fee = $department_corporate_fee?->fee;
        } else {
            $this->department_corporate_fee = 0;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where('registration_no', $this->umr)->first();
        if ($patient) {
            $this->patient = $patient;
            $this->patient_name = $patient?->name;
            $this->patient_age = $patient?->age;
            $this->patient_gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;
            $this->id_type_id = $patient?->id_type_id;

            $this->employee_no = $this->umr;
            $this->employee_name = $patient?->name;

            $patientVisit = $patient->patientvisits()->latest()->first();

            $this->department_id = $patientVisit?->department_id;
            $this->patient_visit_id = $patientVisit?->id;
            $this->visit_type_id = $patientVisit?->visit_type_id;

            $this->departmentChanged();
            $this->unit_id = $patientVisit?->unit_id;
        }
    }

    public function organizationChanged()
    {
        $organization = Organization::where('id', $this->organization_id)->first();

        if ($organization) {
            $this->organization_code = $organization->code;

            if ($this->department_id) {
                $this->department_corporate_fee();
            } else {
                $this->department_corporate_fee = 0;
            }
        }
    }

    public function departmentChanged()
    {
        $department = Department::where('id', $this->department_id)->first();

        if ($department) {
            $this->department_name = $department->name;
        }

        $this->units = Unit::where("department_id", $this->department_id)->get();
        $this->doctors = Doctor::where('department_id', $this->department_id)->latest()->get();

        if ($this->department_id && $this->organization_id) {
            $this->department_corporate_fee();
        } else {
            $this->department_corporate_fee = 0;
        }
    }

    public function consultantChanged()
    {
        $doctor = Doctor::where('id', $this->consultant_id)->first();
        if ($doctor) {
            $this->consultant_code = $doctor->code;
            // $this->consultant_fee = $doctor->fee;
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $corporate_registration = IpdCorporateRegistration::create([
            "patient_id" => $this->patient->id,
            "organization_id" => $this->organization_id,
            "relationship_to_emp" => $this->relationship_to_emp,
            "corporate_relation_id" => $this->corporate_relation_id,
            "department_id" => $this->department_id,
            "unit_id" => $this->unit_id,
            "cost_center_id" => $this->cost_center_id,
            "medical_card_no" => $this->medical_card_no,
            "card_validity" => $this->card_validity,
            "employee_no" => $this->employee_no,
            "employee_name" => $this->employee_name,
            "employee_designation" => $this->employee_designation,
            "referral_letter_no" => $this->referral_letter_no,
            "referral_letter_date" => $this->referral_letter_date,
            "purpose" => $this->purpose,
            "payment_mode" => $this->payment_mode,
            "letter_for" => $this->letter_for,
            "tpa_name" => $this->tpa_name,
            "diagnosis" => $this->diagnosis,
            "corporate_fee" => $this->department_corporate_fee ?? 0,
            "letter_issued_by" => $this->letter_issued_by,
            "created_by_id" => auth()->user()?->id,
        ]);

        if ($corporate_registration) {
            CorporateConsultation::create([
                'corporate_registration_id' => $corporate_registration->id,
                'organization_id' => $this->organization_id,
                'patient_id' => $this->patient->id,
                'patient_visit_id' => $this->patient_visit_id,
                'code' => $this->generateCode(),
                'type' => $this->type,
                'payment_by' => $this->payment_by,
                'visit_type_id' => $this->visit_type_id,
                'doctor_id' => $this->consultant_id,
                'chief_complaint' => $this->chief_complaint,
                'remarks' => $this->remarks,
                'created_by_id' => auth()->user()?->id,
            ]);
        }

        session()->flash("success", "Corporate Registration Created Successfully.");

        return redirect()->route('admin.ipd.corporate-registration-print', $corporate_registration->id);
    }

    public function resetInput()
    {
        $this->umr = '';
        $this->patient_name = '';
        $this->patient_age = '';
        $this->patient_gender = '';
        $this->patient_type = '';
        $this->employee_no = '';
        $this->employee_name = '';
        $this->employee_designation = '';
        $this->organization_id = '';
        $this->organization_code = '';
        $this->department_id = '';
        $this->unit_id = '';
        $this->cost_center_id = '';
        $this->corporate_relation_id = '';
        $this->medical_card_no = '';
        $this->card_validity = '';
        $this->referral_letter_no = '';
        $this->referral_letter_date = '';
        $this->purpose = '';
        $this->payment_mode = 'cash';
        $this->letter_for = '';
        $this->tpa_name = '';
        $this->diagnosis = '';
        $this->letter_issued_by = '';
        $this->patient = null;
        $this->patient_visit_id = '';
        $this->payment_by = '';
        $this->visit_type_id = '';
        $this->consultant_id = '';
        $this->chief_complaint = '';
        $this->remarks = '';
        $this->type = '';
        $this->id_type_id = '';
    }

    public function render()
    {
        return view('livewire.ipd.corporate-registration.corporate-registration')->extends('layouts.admin')->section('content');
    }
}

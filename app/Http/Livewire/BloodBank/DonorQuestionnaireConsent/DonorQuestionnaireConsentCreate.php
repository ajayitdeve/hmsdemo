<?php

namespace App\Http\Livewire\BloodBank\DonorQuestionnaireConsent;

use App\Models\BloodDonorQuestionnaireConsent;
use App\Models\Donor;
use App\Models\Ipd\Ipd;
use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;

class DonorQuestionnaireConsentCreate extends Component
{
    public $voluntary;
    public $donor_id, $donor_title, $donor_name, $donor_father_name, $donor_age, $donor_gender;
    public $umr, $patient_id, $patient_title, $patient_name, $patient_father_name, $patient_age, $patient_gender;
    public $ipd_id, $blood_bag_no;
    public $call_status, $call_status_remarks, $donation_status, $donation_occasion, $last_meal, $last_blood_donated, $last_meal_time, $discomfort_status, $discomfort_status_remarks;
    public $well_status, $well_status_remarks, $eat_status, $eat_status_remarks, $sleep_status, $sleep_status_remarks, $reason_status, $reason_status_remarks, $unexplained_weight_loss, $swollen_gland, $repeated_diarrhoea, $continuous_low_grade_fever;
    public $tattooing, $ear_piarcing, $dental_extration, $heart_disease, $lung_disease, $kedney_disease, $cancer_disease, $epilepsy, $diabetes, $tuberculosis, $abnormal_bleeding_tendency;
    public $hepatitis_bc, $allergic_disease, $jaundice, $sexual_transmitted_disease, $malaria, $typhoid, $fainting_spells, $antibiotics, $aspirin, $alcohol, $steroids, $vaccinations, $dog_bites_rabies_vaccine;
    public $major, $minor, $bt, $pregnant_status, $aberration_status, $child_status, $abnormal_test_result, $read_and_understand;
    public $weight, $pulse, $hb, $bp, $temperature, $accept_terms, $reason;

    public $patients = [];
    public $ipds = [];
    public $donors = [];
    public function mount()
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->donors = Donor::whereDoesntHave("questionnaire_consent")->latest()->get();

        $this->voluntary = 1;
        $this->call_status = 1;
        $this->donation_status = 0;
        $this->discomfort_status = 0;
        $this->well_status = 1;
        $this->eat_status = 0;
        $this->sleep_status = 1;
        $this->reason_status = 0;
        $this->pregnant_status = 0;
        $this->aberration_status = 0;
        $this->child_status = 0;
        $this->abnormal_test_result = 1;
        $this->read_and_understand = 1;
        $this->accept_terms = 1;
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_title = $patient?->title?->name;
            $this->patient_name = $patient?->name;
            $this->patient_father_name = $patient?->father_name;
            $this->patient_age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_gender = $patient?->gender?->name;

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;

            $this->donors = Donor::where("patient_id", $this->patient_id)->latest()->get();
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_title = $ipd?->patient?->title?->name;
            $this->patient_name = $ipd?->patient?->name;
            $this->patient_father_name = $ipd?->patient?->father_name;
            $this->patient_age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_gender = $ipd?->patient?->gender?->name;
        }
    }

    public function donorChanged()
    {
        $donor = Donor::find($this->donor_id);

        if ($donor) {
            $this->donor_id = $donor->id;
            $this->donor_title = $donor?->title?->name;
            $this->donor_name = $donor?->name;
            $this->donor_father_name = $donor?->father_name;
            $this->donor_age = Carbon::parse($donor?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->donor_gender = $donor?->gender?->name;

            $this->ipd_id = $donor->ipd_id;
            $this->patient_id = $donor->patient_id;

            $patient = Patient::where("id", $this->patient_id)->first();
            if ($patient) {
                $this->umr = $patient->registration_no;
                $this->patient_title = $patient?->title?->name;
                $this->patient_name = $patient?->name;
                $this->patient_father_name = $patient?->father_name;
                $this->patient_age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
                $this->patient_gender = $patient?->gender?->name;
            }
        }
    }

    public function rules()
    {
        return [
            "donor_id" => "required|unique:App\Models\BloodDonorQuestionnaireConsent,donor_id",
        ];
    }

    public function save()
    {
        $this->validate();

        BloodDonorQuestionnaireConsent::create([
            "ipd_id" => $this->ipd_id,
            "patient_id" => $this->patient_id,
            "donor_id" => $this->donor_id,
            "blood_bag_no" => $this->blood_bag_no,
            "code" => "BDQC" . BloodDonorQuestionnaireConsent::max("id") + 1,
            "voluntary" => $this->voluntary,
            "call_status" => $this->call_status,
            "call_status_remarks" => $this->call_status_remarks,
            "donation_status" => $this->donation_status,
            "donation_occasion" => $this->donation_occasion,
            "last_meal" => $this->last_meal,
            "last_blood_donated" => $this->last_blood_donated,
            "last_meal_time" => $this->last_meal_time,
            "discomfort_status" => $this->discomfort_status,
            "discomfort_status_remarks" => $this->discomfort_status_remarks,
            "well_status" => $this->well_status,
            "well_status_remarks" => $this->well_status_remarks,
            "eat_status" => $this->eat_status,
            "eat_status_remarks" => $this->eat_status_remarks,
            "sleep_status" => $this->sleep_status,
            "sleep_status_remarks" => $this->sleep_status_remarks,
            "reason_status" => $this->reason_status,
            "reason_status_remarks" => $this->reason_status_remarks,
            "unexplained_weight_loss" => $this->unexplained_weight_loss,
            "swollen_gland" => $this->swollen_gland,
            "repeated_diarrhoea" => $this->repeated_diarrhoea,
            "continuous_low_grade_fever" => $this->continuous_low_grade_fever,
            "tattooing" => $this->tattooing,
            "ear_piarcing" => $this->ear_piarcing,
            "dental_extration" => $this->dental_extration,
            "heart_disease" => $this->heart_disease,
            "lung_disease" => $this->lung_disease,
            "kedney_disease" => $this->kedney_disease,
            "cancer_disease" => $this->cancer_disease,
            "epilepsy" => $this->epilepsy,
            "diabetes" => $this->diabetes,
            "tuberculosis" => $this->tuberculosis,
            "abnormal_bleeding_tendency" => $this->abnormal_bleeding_tendency,
            "hepatitis_bc" => $this->hepatitis_bc,
            "allergic_disease" => $this->allergic_disease,
            "jaundice" => $this->jaundice,
            "sexual_transmitted_disease" => $this->sexual_transmitted_disease,
            "malaria" => $this->malaria,
            "typhoid" => $this->typhoid,
            "fainting_spells" => $this->fainting_spells,
            "antibiotics" => $this->antibiotics,
            "aspirin" => $this->aspirin,
            "alcohol" => $this->alcohol,
            "steroids" => $this->steroids,
            "vaccinations" => $this->vaccinations,
            "dog_bites_rabies_vaccine" => $this->dog_bites_rabies_vaccine,
            "major" => $this->major,
            "minor" => $this->minor,
            "bt" => $this->bt,
            "pregnant_status" => $this->pregnant_status,
            "aberration_status" => $this->aberration_status,
            "child_status" => $this->child_status,
            "abnormal_test_result" => $this->abnormal_test_result,
            "read_and_understand" => $this->read_and_understand,
            "weight" => $this->weight,
            "pulse" => $this->pulse,
            "hb" => $this->hb,
            "bp" => $this->bp,
            "temperature" => $this->temperature,
            "accept_terms" => $this->accept_terms,
            "reason" => $this->reason,
            "created_by_id"  => auth()->user()?->id
        ]);

        session()->flash('message', 'Donor Questionnaire Consent Added Successfully.');
        return redirect()->route('admin.blood-bank.donor-questionnaire-and-consent');
    }

    public function render()
    {
        return view('livewire.blood-bank.donor-questionnaire-consent.donor-questionnaire-consent-create')->extends('layouts.admin')->section('content');
    }
}

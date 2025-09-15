<?php

namespace App\Http\Livewire\BloodBank\DonorQuestionnaireConsent;

use App\Models\BloodDonorQuestionnaireConsent;
use App\Models\Donor;
use App\Models\Ipd\Ipd;
use App\Models\Patient;
use Carbon\Carbon;
use Livewire\Component;

class DonorQuestionnaireConsentEdit extends Component
{
    public $blood_questionnaire_consent_id, $voluntary;
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

    public function mount($id)
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->donors = Donor::latest()->get();

        $blood_questionnaire_consent = BloodDonorQuestionnaireConsent::find($id);
        if ($blood_questionnaire_consent) {
            $this->blood_questionnaire_consent_id = $blood_questionnaire_consent->id;
            $this->ipd_id = $blood_questionnaire_consent->ipd_id;
            $this->patient_id = $blood_questionnaire_consent->patient_id;

            $this->umr = $blood_questionnaire_consent?->patient?->registration_no;
            $this->patient_title = $blood_questionnaire_consent?->patient?->title?->name;
            $this->patient_name = $blood_questionnaire_consent?->patient?->name;
            $this->patient_father_name = $blood_questionnaire_consent?->patient?->father_name;
            $this->patient_age = Carbon::parse($blood_questionnaire_consent?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_gender = $blood_questionnaire_consent?->patient?->gender?->name;

            $this->donor_id = $blood_questionnaire_consent->donor_id;

            $this->donor_title = $blood_questionnaire_consent?->donor?->title?->name;
            $this->donor_name = $blood_questionnaire_consent?->donor?->name;
            $this->donor_father_name = $blood_questionnaire_consent?->donor?->father_name;
            $this->donor_age = Carbon::parse($blood_questionnaire_consent?->donor?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->donor_gender = $blood_questionnaire_consent?->donor?->gender?->name;

            $this->blood_bag_no = $blood_questionnaire_consent->blood_bag_no;
            $this->voluntary = $blood_questionnaire_consent->voluntary;
            $this->call_status = $blood_questionnaire_consent->call_status;
            $this->call_status_remarks = $blood_questionnaire_consent->call_status_remarks;
            $this->donation_status = $blood_questionnaire_consent->donation_status;
            $this->donation_occasion = $blood_questionnaire_consent->donation_occasion;
            $this->last_meal = $blood_questionnaire_consent->last_meal;
            $this->last_blood_donated = $blood_questionnaire_consent->last_blood_donated;
            $this->last_meal_time = $blood_questionnaire_consent->last_meal_time;
            $this->discomfort_status = $blood_questionnaire_consent->discomfort_status;
            $this->discomfort_status_remarks = $blood_questionnaire_consent->discomfort_status_remarks;
            $this->well_status = $blood_questionnaire_consent->well_status;
            $this->well_status_remarks = $blood_questionnaire_consent->well_status_remarks;
            $this->eat_status = $blood_questionnaire_consent->eat_status;
            $this->eat_status_remarks = $blood_questionnaire_consent->eat_status_remarks;
            $this->sleep_status = $blood_questionnaire_consent->sleep_status;
            $this->sleep_status_remarks = $blood_questionnaire_consent->sleep_status_remarks;
            $this->reason_status = $blood_questionnaire_consent->reason_status;
            $this->reason_status_remarks = $blood_questionnaire_consent->reason_status_remarks;
            $this->unexplained_weight_loss = $blood_questionnaire_consent->unexplained_weight_loss;
            $this->swollen_gland = $blood_questionnaire_consent->swollen_gland;
            $this->repeated_diarrhoea = $blood_questionnaire_consent->repeated_diarrhoea;
            $this->continuous_low_grade_fever = $blood_questionnaire_consent->continuous_low_grade_fever;
            $this->tattooing = $blood_questionnaire_consent->tattooing;
            $this->ear_piarcing = $blood_questionnaire_consent->ear_piarcing;
            $this->dental_extration = $blood_questionnaire_consent->dental_extration;
            $this->heart_disease = $blood_questionnaire_consent->heart_disease;
            $this->lung_disease = $blood_questionnaire_consent->lung_disease;
            $this->kedney_disease = $blood_questionnaire_consent->kedney_disease;
            $this->cancer_disease = $blood_questionnaire_consent->cancer_disease;
            $this->epilepsy = $blood_questionnaire_consent->epilepsy;
            $this->diabetes = $blood_questionnaire_consent->diabetes;
            $this->tuberculosis = $blood_questionnaire_consent->tuberculosis;
            $this->abnormal_bleeding_tendency = $blood_questionnaire_consent->abnormal_bleeding_tendency;
            $this->hepatitis_bc = $blood_questionnaire_consent->hepatitis_bc;
            $this->allergic_disease = $blood_questionnaire_consent->allergic_disease;
            $this->jaundice = $blood_questionnaire_consent->jaundice;
            $this->sexual_transmitted_disease = $blood_questionnaire_consent->sexual_transmitted_disease;
            $this->malaria = $blood_questionnaire_consent->malaria;
            $this->typhoid = $blood_questionnaire_consent->typhoid;
            $this->fainting_spells = $blood_questionnaire_consent->fainting_spells;
            $this->antibiotics = $blood_questionnaire_consent->antibiotics;
            $this->aspirin = $blood_questionnaire_consent->aspirin;
            $this->alcohol = $blood_questionnaire_consent->alcohol;
            $this->steroids = $blood_questionnaire_consent->steroids;
            $this->vaccinations = $blood_questionnaire_consent->vaccinations;
            $this->dog_bites_rabies_vaccine = $blood_questionnaire_consent->dog_bites_rabies_vaccine;
            $this->major = $blood_questionnaire_consent->major;
            $this->minor = $blood_questionnaire_consent->minor;
            $this->bt = $blood_questionnaire_consent->bt;
            $this->pregnant_status = $blood_questionnaire_consent->pregnant_status;
            $this->aberration_status = $blood_questionnaire_consent->aberration_status;
            $this->child_status = $blood_questionnaire_consent->child_status;
            $this->abnormal_test_result = $blood_questionnaire_consent->abnormal_test_result;
            $this->read_and_understand = $blood_questionnaire_consent->read_and_understand;
            $this->weight = $blood_questionnaire_consent->weight;
            $this->pulse = $blood_questionnaire_consent->pulse;
            $this->hb = $blood_questionnaire_consent->hb;
            $this->bp = $blood_questionnaire_consent->bp;
            $this->temperature = $blood_questionnaire_consent->temperature;
            $this->accept_terms = $blood_questionnaire_consent->accept_terms;
            $this->reason = $blood_questionnaire_consent->reason;

            $this->donors = Donor::whereDoesntHave('questionnaire_consent')
                ->orWhere('id', $this->donor_id)
                ->latest()
                ->get();
        }
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
            "donor_id" => "required|unique:App\Models\BloodDonorQuestionnaireConsent,donor_id," . $this->blood_questionnaire_consent_id,
        ];
    }

    public function save()
    {
        $this->validate();

        $blood_questionnaire_consent = BloodDonorQuestionnaireConsent::find($this->blood_questionnaire_consent_id);
        if ($blood_questionnaire_consent) {
            $blood_questionnaire_consent->update([
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                "donor_id" => $this->donor_id,
                "blood_bag_no" => $this->blood_bag_no,
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
            ]);

            session()->flash('message', 'Donor Questionnaire Consent Updated Successfully.');
            return redirect()->route('admin.blood-bank.donor-questionnaire-and-consent');
        }

        session()->flash('error', 'Something went wrong.');
    }
    public function render()
    {
        return view('livewire.blood-bank.donor-questionnaire-consent.donor-questionnaire-consent-edit')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\BloodBank\DonorBleeding;

use App\Models\BagType;
use App\Models\BloodDonorBleeding;
use App\Models\BloodDonorQuestionnaireConsent;
use App\Models\Bloodgroup;
use App\Models\Doctor;
use App\Models\Donor;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Title;
use Carbon\Carbon;
use Livewire\Component;

class DonorBleedingEdit extends Component
{
    public $blood_donor_bleeding_id, $type = "in-patient", $patient_id, $umr, $title_id, $patient_name, $age, $gender_id, $ipd_id, $admn_no, $mobile, $address, $out_side_patient_id;
    public $donor_id, $donor_title, $donor_name, $donor_father_name, $donor_age, $donor_gender;
    public $blood_donor_questionnaire_consent_id, $bleeding_no, $blood_bag_no, $blood_bag_date, $bag_type_id, $bloodgroup_id, $volume, $tube_no, $temperature, $hemoglobin, $lagtime, $weight, $pulse, $bleeding_from_time, $bleeding_to_time;
    public $phlebotomy_site, $bp, $phlebotomist, $staff_nurse, $doctor_id, $doctor_code;

    public $donors = [];
    public $donor_questionnaire_consents = [];
    public $bag_types = [];
    public $bloodgroups = [];
    public $titles = [];
    public $genders = [];
    public $patients = [];
    public $ipds = [];
    public $doctors = [];
    public function mount($id)
    {
        $this->donors = Donor::whereHas("questionnaire_consent")
            ->whereDoesntHave("bleeding")
            ->latest()
            ->get();

        $this->donor_questionnaire_consents = BloodDonorQuestionnaireConsent::latest()->get();
        $this->bag_types = BagType::where("is_active", "1")->latest()->get();
        $this->bloodgroups = Bloodgroup::latest()->get();

        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->doctors = Doctor::latest()->get();

        $blood_donor_bleeding = BloodDonorBleeding::find($id);
        if ($blood_donor_bleeding) {
            $this->blood_donor_bleeding_id = $blood_donor_bleeding->id;
            $this->type = $blood_donor_bleeding->type;
            $this->ipd_id = $blood_donor_bleeding->ipd_id;
            $this->patient_id = $blood_donor_bleeding->patient_id;

            if ($this->type == "in-patient") {
                $this->umr = $blood_donor_bleeding?->patient?->registration_no;
                $this->patient_name = $blood_donor_bleeding?->ipd?->patient?->name;
                $this->title_id = $blood_donor_bleeding?->ipd?->patient?->title_id;
                $this->gender_id = $blood_donor_bleeding?->ipd?->patient?->gender_id;
                $this->age = Carbon::parse($blood_donor_bleeding?->ipd?->patient?->dob)->diff(Carbon::now())->format('%y');
                $this->admn_no = $blood_donor_bleeding?->ipd?->ipdcode;
                $this->admn_no = $blood_donor_bleeding?->ipd?->ipdcode;
            }

            if ($this->type == "out-patient") {
                $this->umr = $blood_donor_bleeding?->patient?->registration_no;
                $this->patient_name = $blood_donor_bleeding?->patient?->name;
                $this->title_id = $blood_donor_bleeding?->patient?->title_id;
                $this->gender_id = $blood_donor_bleeding?->patient?->gender_id;
                $this->age = Carbon::parse($blood_donor_bleeding?->patient?->dob)->diff(Carbon::now())->format('%y');
                $this->admn_no = $blood_donor_bleeding?->ipd?->ipdcode;
            }

            if ($this->type == "outside-patient") {
                $this->out_side_patient_id = $blood_donor_bleeding?->out_side_patient_id;
                $this->patient_name = $blood_donor_bleeding?->out_side_patient?->name;
                $this->mobile = $blood_donor_bleeding?->out_side_patient?->mobile;
                $this->age = $blood_donor_bleeding?->out_side_patient?->age;
                $this->address = $blood_donor_bleeding?->out_side_patient?->address;
                $this->title_id = $blood_donor_bleeding?->out_side_patient?->title_id;
                $this->gender_id = $blood_donor_bleeding?->out_side_patient?->gender_id;
            }

            $this->donor_id = $blood_donor_bleeding->donor_id;
            $this->donor_title = $blood_donor_bleeding?->donor?->title?->name;
            $this->donor_name = $blood_donor_bleeding?->donor?->name;
            $this->donor_age = Carbon::parse($blood_donor_bleeding?->donor?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->donor_gender = $blood_donor_bleeding?->donor?->gender?->name;
            $this->donor_father_name = $blood_donor_bleeding?->donor?->father_name;

            $this->blood_donor_questionnaire_consent_id = $blood_donor_bleeding->blood_donor_questionnaire_consent_id;
            $this->bleeding_no = $blood_donor_bleeding->code;
            $this->blood_bag_no = $blood_donor_bleeding->blood_bag_no;
            $this->blood_bag_date = date("Y-m-d H:i", strtotime($blood_donor_bleeding->created_at));
            $this->bag_type_id = $blood_donor_bleeding->bag_type_id;
            $this->bloodgroup_id = $blood_donor_bleeding->bloodgroup_id;
            $this->volume = $blood_donor_bleeding->volume;
            $this->tube_no = $blood_donor_bleeding->tube_no;
            $this->temperature = $blood_donor_bleeding->temperature;
            $this->hemoglobin = $blood_donor_bleeding->hemoglobin;
            $this->lagtime = $blood_donor_bleeding->lagtime;
            $this->weight = $blood_donor_bleeding->weight;
            $this->pulse = $blood_donor_bleeding->pulse;
            $this->bleeding_from_time = date("Y-m-d H:i", strtotime($blood_donor_bleeding->bleeding_from_time));
            $this->bleeding_to_time = date("Y-m-d H:i", strtotime($blood_donor_bleeding->bleeding_to_time));
            $this->phlebotomy_site = $blood_donor_bleeding->phlebotomy_site;
            $this->bp = $blood_donor_bleeding->bp;
            $this->phlebotomist = $blood_donor_bleeding->phlebotomist;
            $this->staff_nurse = $blood_donor_bleeding->staff_nurse;
            $this->doctor_id = $blood_donor_bleeding->doctor_id;
            $this->doctorChanged();

            $this->donors = Donor::whereHas("questionnaire_consent")
                ->whereDoesntHave("bleeding")
                ->orWhere("id", $this->donor_id)
                ->latest()
                ->get();
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
            $this->admn_no = $ipd?->ipdcode;
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

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;
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
            $this->bloodgroup_id = $donor->bloodgroup_id;
            $this->patient_id = $donor->patient_id;
            $this->ipd_id = $donor->ipd_id;
            $this->blood_donor_questionnaire_consent_id = $donor->questionnaire_consent?->id;

            $this->ipdChanged();

            $this->weight = $donor?->questionnaire_consent?->weight;
            $this->pulse = $donor?->questionnaire_consent?->pulse;
            $this->hemoglobin = $donor?->questionnaire_consent?->hb;
            $this->bp = $donor?->questionnaire_consent?->bp;
            $this->temperature = $donor?->questionnaire_consent?->temperature;
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
        return [
            'patient_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/'],
            'title_id' => 'required_if:type,outside-patient',
            'gender_id' => 'required_if:type,outside-patient',
            'bleeding_no' => 'required',
            'blood_bag_no' => 'required',
            'bleeding_from_time' => 'required',
            'bleeding_to_time' => 'required',
            'donor_id' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
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

        $blood_donor_bleeding = BloodDonorBleeding::find($this->blood_donor_bleeding_id);
        if ($blood_donor_bleeding) {
            $blood_donor_bleeding->update([
                'ipd_id' => $this->ipd_id,
                'patient_id' => $this->patient_id,
                'type' => $this->type,
                'out_side_patient_id' => $this->out_side_patient_id,
                'donor_id' => $this->donor_id,
                'blood_donor_questionnaire_consent_id' => $this->blood_donor_questionnaire_consent_id,
                'bag_type_id' => $this->bag_type_id,
                'bloodgroup_id' => $this->bloodgroup_id,
                'volume' => $this->volume,
                'tube_no' => $this->tube_no,
                'temperature' => $this->temperature,
                'hemoglobin' => $this->hemoglobin,
                'lagtime' => $this->lagtime,
                'weight' => $this->weight,
                'pulse' => $this->pulse,
                'bleeding_from_time' => $this->bleeding_from_time,
                'bleeding_to_time' => $this->bleeding_to_time,
                'phlebotomy_site' => $this->bleeding_to_time,
                'bp' => $this->bp,
                'phlebotomist' => $this->phlebotomist,
                'staff_nurse' => $this->staff_nurse,
                'doctor_id' => $this->doctor_id,
            ]);

            session()->flash('message', 'Donor Bleeding Updated Successfully.');
            return redirect()->route('admin.blood-bank.donor-bleeding');
        }

        session()->flash('error', 'Something went wrong.');
    }
    public function render()
    {
        return view('livewire.blood-bank.donor-bleeding.donor-bleeding-edit')->extends('layouts.admin')->section('content');
    }
}

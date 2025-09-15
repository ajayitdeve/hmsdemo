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

class DonorBleedingCreate extends Component
{
    public $type = "in-patient", $patient_id, $umr, $title_id, $patient_name, $age, $gender_id, $ipd_id, $admn_no, $mobile, $address, $out_side_patient_id;
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
    public function mount()
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

        $this->bleeding_no = "DB" . BloodDonorBleeding::max("id") + 1;
        $this->blood_bag_no = "BG" . BloodDonorBleeding::max("id") + 1;
        $this->blood_bag_date = date("Y-m-d H:i");
        $this->bleeding_from_time = date("Y-m-d H:i");
        $this->bleeding_to_time = date("Y-m-d H:i");
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

        BloodDonorBleeding::create([
            'ipd_id' => $this->ipd_id,
            'patient_id' => $this->patient_id,
            'type' => $this->type,
            'out_side_patient_id' => $this->out_side_patient_id,
            'donor_id' => $this->donor_id,
            'blood_donor_questionnaire_consent_id' => $this->blood_donor_questionnaire_consent_id,
            'code' => $this->bleeding_no,
            'blood_bag_no' => $this->blood_bag_no,
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
            'phlebotomy_site' => $this->phlebotomy_site,
            'bp' => $this->bp,
            'phlebotomist' => $this->phlebotomist,
            'staff_nurse' => $this->staff_nurse,
            'doctor_id' => $this->doctor_id,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'Donor Bleeding Added Successfully.');
        return redirect()->route('admin.blood-bank.donor-bleeding');
    }

    public function render()
    {
        return view('livewire.blood-bank.donor-bleeding.donor-bleeding-create')->extends('layouts.admin')->section('content');
    }
}

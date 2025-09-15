<?php

namespace App\Http\Livewire\BloodBank\DonorRegistration;

use App\Models\Bloodgroup;
use App\Models\Donor;
use App\Models\Gender;
use App\Models\IdType;
use App\Models\Ipd\Ipd;
use App\Models\Marital;
use App\Models\Nationality;
use App\Models\Occupation;
use App\Models\Patient;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\Title;
use App\Models\Village;
use Carbon\Carbon;
use Livewire\Component;

class DonorRegistrationEdit extends Component
{
    public $donor_id, $ipd_id, $umr, $patient_id, $patient_title, $patient_name, $patient_age, $patient_gender, $ward, $room, $bed;
    public $title_id, $name, $dob, $age, $email, $mobile, $address;
    public $religion_id, $occupation_id, $nationality_id, $relation_id, $gender_id, $marital_id, $bloodgroup_id;
    public $pulse, $bp, $hb, $weight;
    public $village_id;
    public $pincode, $father_name, $mother_name, $rawage;
    public $village_text;

    //for state city dropdown
    public $villages = [], $titles = [], $religions = [], $occupations = [], $nationalities = [], $relations = [], $genders = [], $maritals = [], $bloodgroups = [], $patienttypes = [];
    public $defaultState;
    public $ageError = '';

    //for identification no
    public $identification_no, $id_type_id, $idTypes = [];
    //remarks
    public $remarks;

    public $ipds = [];
    public $patients = [];

    public function mount($id)
    {
        $this->titles = Title::get();
        $this->religions = Religion::get();
        $this->occupations = Occupation::get();
        $this->relations = Relation::get();
        $this->nationalities = Nationality::get();
        $this->genders = Gender::get();
        $this->maritals = Marital::get();
        $this->bloodgroups = Bloodgroup::get();

        //for identification no
        $this->idTypes = IdType::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();

        $donor = Donor::find($id);
        if ($donor) {
            $this->donor_id = $donor->id;
            $this->ipd_id = $donor->ipd_id;
            $this->ipdChanged();
            $this->patient_id = $donor->patient_id;
            $this->title_id = $donor->title_id;
            $this->name = $donor->name;
            $this->dob = $donor->dob;
            $this->calculateAge();
            $this->age = $donor->age;
            $this->gender_id = $donor->gender_id;
            $this->marital_id = $donor->marital_id;
            $this->bloodgroup_id = $donor->bloodgroup_id;
            $this->email = $donor->email;
            $this->mobile = $donor->mobile;
            $this->village_id = $donor->village_id;
            $this->religion_id = $donor->religion_id;
            $this->occupation_id = $donor->occupation_id;
            $this->address = $donor->address;
            $this->pincode = $donor->pincode;
            $this->nationality_id = $donor->nationality_id;
            $this->relation_id = $donor->relation_id;
            $this->father_name = $donor->father_name;
            $this->mother_name = $donor->mother_name;
            $this->id_type_id = $donor->id_type_id;
            $this->identification_no = $donor->identification_no;
            $this->remarks = $donor->remarks;

            $this->pulse = $donor->pulse;
            $this->bp = $donor->bp;
            $this->hb = $donor->hb;
            $this->weight = $donor->weight;
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_name = $ipd?->patient?->name;
            $this->patient_title = $ipd?->patient?->title?->name;
            $this->patient_age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->patient_title = $patient->title?->name;
            $this->patient_age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_gender = $patient?->gender?->name;

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;
        }
    }

    public function titleChanged()
    {
        $title = Title::find($this->title_id);
        $this->gender_id = $title->gender_id;
    }

    public function genderChanged()
    {
        $title = Title::where("gender_id", $this->gender_id)->first();
        if ($title) {
            $this->title_id = $title->id;
        } else {
            $this->title_id = Title::first()?->id;
        }
    }

    //calculate age
    public function calculateAge()
    {
        $date = Carbon::parse($this->dob);
        $testdate = $date->diffInYears(Carbon::now());
        //dd($testdate);
        if ($testdate <= 100) {
            $parsedDOB = Carbon::parse($this->dob);
            $this->age = Carbon::parse($parsedDOB)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->rawage = Carbon::parse($parsedDOB)->age;
            $this->ageError = "";
        } else {
            $parsedDOB = Carbon::parse($this->dob);
            $this->age = 'Invalid';
            $this->ageError = "Age Must be less than 100";
        }
    }

    public function changeRwaAge()
    {
        if ((int) ($this->rawage) >= 99) {
            $this->ageError = "Age Must be less than 100";
            $this->age = 'Invalid';
        } else {
            $this->ageError = "";
        }
        $currentDate = Carbon::now();
        $newDate = Carbon::now()->subYears((int) $this->rawage);
        $this->age = Carbon::parse($newDate)->diff(Carbon::now())->format('%y years, %m months and %d days');
        $this->dob = $newDate->format('Y-m-d');
    }

    public function villageChanged()
    {
        if ($this->village_text == null) {
            $this->villages = [];
            $this->village_id = null;
        } else {
            $this->villages = Village::orWhere('name', 'like', '%' . $this->village_text . '%')->get();
        }
    }

    public function villageSelectionChanged()
    {
        if ($this->village_id != -1) {
            $this->village_text = null;
            //setting complaete address
            $village = Village::find($this->village_id);
            $this->address = $village->name . ', Block-' . $village->block->name . ', District-' . $village->district->name . ' ,' . $village->state->name;
        } else {
            $this->address = null;
        }
    }

    public function rules()
    {
        return [
            // 'ipd_id' => 'required',
            // 'patient_id' => 'required',
            // 'umr' => 'required',
            'title_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'gender_id' => 'required',
            'marital_id' => 'required',
            'nationality_id' => 'required',
            'father_name' => 'required',
            'relation_id' => 'required',
            'religion_id' => 'required',
            'occupation_id' => 'required',
            'address' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function confirmation()
    {
        $this->validate();
        $this->dispatchBrowserEvent('open-confirmation-modal');
    }

    public function save()
    {
        $this->validate();

        $donor = Donor::find($this->donor_id);
        if ($donor) {
            $donor->update([
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                'title_id' => $this->title_id,
                'name' => $this->name,
                'dob' => $this->dob,
                'age' => $this->age,
                'gender_id' => $this->gender_id,
                'marital_id' => $this->marital_id,
                'bloodgroup_id' => $this->bloodgroup_id,
                'email' => $this->email,
                'mobile' => $this->mobile,
                'village_id' => $this->village_id,
                'religion_id' => $this->religion_id,
                'occupation_id' => $this->occupation_id,
                'address' => $this->address,
                'pincode' => $this->pincode,
                'nationality_id' => $this->nationality_id,
                'relation_id' => $this->relation_id,
                'father_name' => $this->father_name,
                'mother_name' => $this->mother_name,
                'id_type_id' => $this->id_type_id != null ? $this->id_type_id : null,
                'identification_no' => $this->id_type_id != null && $this->identification_no != null ? $this->identification_no : null,
                'remarks' => $this->remarks,
                'pulse' => $this->pulse,
                'bp' => $this->bp,
                'hb' => $this->hb,
                'weight' => $this->weight,
            ]);

            session()->flash('message', 'Donor Updated Successfully.');
            $this->dispatchBrowserEvent('close-modal');
            return redirect()->route('admin.blood-bank.donor-registration');
        }

        session()->flash('message', 'Something went wront ! Try Again');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.blood-bank.donor-registration.donor-registration-edit')->extends('layouts.admin')->section('content');
    }
}

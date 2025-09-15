<?php

namespace App\Http\Livewire\Patient;

use Carbon\Carbon;
use App\Models\Other;
use App\Models\Staff;
use App\Models\Title;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\IdType;
use App\Models\Marital;
use App\Models\Village;
use Livewire\Component;
use App\Models\Hospital;
use App\Models\Referral;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\Bloodgroup;
use App\Models\Occupation;
use App\Models\Nationality;
use App\Models\PatientType;
use App\Models\HealthCoordinator;
use App\Traits\PatientRegistration;


class NewPatientRegistration extends Component
{
    use PatientRegistration;
    //for state city dropdown
    public $villages = [], $titles = [], $religions = [], $occupations = [], $nationalities = [], $relations = [], $genders = [], $maritals = [], $bloodgroups = [], $patienttypes = [], $age;
    public $title_id, $religion_id, $occupation_id, $nationality_id, $area = '0', $relation_id, $gender_id, $marital_id, $bloodgroup_id;
    public $village_id, $registration_no, $registration_date, $patient_type_id;
    public $name, $dob, $email, $mobile, $address;
    public $pincode, $father_name, $mother_name, $rawage;
    public $village_text;
    //for referral
    public $referrals = [], $referralmenus = [], $referral_id, $referralmenu_id, $referrable_type, $referralmenuname = '';
    public $defaultState;
    public $ageError = '';

    //for identification no
    public $identification_no, $id_type_id, $idTypes = [];
    //remarks
    public $remarks;

    public function mount()
    {
        // $this->referrals = Referral::get();
        $this->referralmenus = [['id' => 1, 'name' => 'Self'], ['id' => 2, 'name' => 'Staff Doctor'], ['id' => 3, 'name' => 'Staff'], ['id' => 4, 'name' => 'Hospital'], ['id' => 5, 'name' => 'Walkin'], ['id' => 6, 'name' => 'Health Coordinator'], ['id' => 7, 'name' => 'Other']];
        $this->patienttypes = PatientType::get();
        $this->titles = Title::get();
        $this->religions = Religion::get();
        $this->occupations = Occupation::get();
        $this->relations = Relation::get();
        $this->nationalities = Nationality::get();
        $this->genders = Gender::get();
        $this->maritals = Marital::get();
        $this->bloodgroups = Bloodgroup::get();

        //initializing dropdowns
        $this->title_id = Title::first()?->id;
        $this->gender_id = Gender::first()?->id;
        $this->marital_id = Marital::first()?->id;
        $this->nationality_id = Nationality::first()?->id;
        // $this->bloodgroup_id=Bloodgroup::first()?->id;
        $this->religion_id = Religion::first()?->id;
        $this->relation_id = Relation::first()?->id;
        $this->occupation_id = Occupation::first()?->id;
        $this->patient_type_id = PatientType::first()?->id;
        // referral setting for default self
        $this->referralmenu_id = 1;
        $this->referral_id = 1;
        $this->referrable_type = '\App\Models\ReferralSelf';
        $this->referralmenuname = 'Self';

        //for identification no
        $this->idTypes = IdType::get();
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'dob' => 'required',
            'age' => 'required',
            'address' => 'required',
            'father_name' => 'required',
            'referralmenu_id' => 'required',
            'patient_type_id' => 'required',
            'title_id' => 'required',
            'gender_id' => 'required',
            'marital_id' => 'required',
            'religion_id' => 'required',
            'occupation_id' => 'required',
            'nationality_id' => 'required',
            'area' => 'required',
            'relation_id' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    //   public function stateChanged()
    //   {
    //     if ($this->state_id != -1) {
    //       $this->cities = City::where('state_id',$this->state_id)->get();
    //     }
    //   }
    // end of city state cascade

    public function titleChanged()
    {
        $title = Title::find($this->title_id);
        $this->gender_id = $title?->gender_id;
    }

    public function genderChanged()
    {
        $title = Title::where("gender_id", $this->gender_id)->first();
        if ($title) {
            $this->title_id = $title?->id;
        } else {
            $this->title_id = Title::first()?->id;
        }
    }

    //referral menu changed
    public function referralmenuChanged()
    {
        if ($this->referralmenu_id == 1) {
            $this->referral_id = 1;
            $this->referrable_type = '\App\Models\ReferralSelf';
            $this->referralmenuname = 'Self';
        }
        if ($this->referralmenu_id == 2) {
            $this->referrals = Doctor::all();
            $this->referrable_type = '\App\Models\Doctor';
            $this->referralmenuname = 'Doctor';
        }
        if ($this->referralmenu_id == 3) {
            $this->referrals = Staff::all();
            $this->referrable_type = '\App\Models\Staff';
            $this->referralmenuname = 'Staff';
        }
        if ($this->referralmenu_id == 4) {
            $this->referrals = Hospital::all();
            $this->referrable_type = '\App\Models\Hospital';
            $this->referralmenuname = 'Hospital';
        }
        if ($this->referralmenu_id == 5) {
            $this->referral_id = 5;
            $this->referrable_type = '\App\Models\ReferralWalking';
            $this->referralmenuname = 'Walking';
        }
        if ($this->referralmenu_id == 6) {
            $this->referrals = HealthCoordinator::all();
            $this->referrable_type = '\App\Models\HealthCoordinator';
            $this->referralmenuname = 'HealthCoordinator';
        }
        if ($this->referralmenu_id == 7) {
            $this->referrals = Other::all();
            $this->referrable_type = '\App\Models\Other';
            $this->referralmenuname = 'Other';
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

    public function confirmation()
    {
        $this->validate();
        $this->dispatchBrowserEvent('open-confirmation-modal');
    }

    public function save()
    {
        $this->validate();

        $patient = [
            'village_id' => $this->village_id,
            'patient_type_id' => $this->patient_type_id,
            'title_id' => $this->title_id,
            'name' => $this->name,
            'dob' => $this->dob,
            'age' => $this->age,
            'gender_id' => $this->gender_id,
            'marital_id' => $this->marital_id,
            'bloodgroup_id' => $this->bloodgroup_id,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'religion_id' => $this->religion_id,
            'occupation_id' => $this->occupation_id,
            'address' => $this->address,
            'pincode' => $this->pincode,
            'nationality_id' => $this->nationality_id,
            'is_rural' => $this->area,
            'father_name' => $this->father_name,
            'relation_id' => $this->relation_id,
            'mother_name' => $this->mother_name,
            //added for Identification no
            'id_type_id' => $this->id_type_id != null ? $this->id_type_id : null,
            'identification_no' => $this->id_type_id != null && $this->identification_no != null ? $this->identification_no : null,
            //reamrks added
            'remarks' => $this->remarks
        ];
        //dd($patient);
        $result = $this->patientRegistration($patient);
        if ($result) {
            //saving referrel
            $ref = new Referral();
            $ref->name = $this->referralmenuname;
            $ref->referrable_type = $this->referrable_type;
            $ref->referrable_id = $this->referral_id;
            $ref->patient_id = $result;
            $res = $ref->save();
            if ($res) {
                session()->flash('message', 'Patient Added Successfully.');
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal');
                return redirect()->route('admin.patient.list');
            }
        } else {
            session()->flash('message', 'Something went wront ! Try Again');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function resetInput()
    {
        $this->referral_id = null;
        //   $this->state_id=null;
        //   $this->city_id=null;
        $this->patient_type_id = null;
        $this->title_id = null;
        $this->name = null;
        $this->dob = null;
        $this->age = null;
        $this->gender_id = null;
        $this->marital_id = null;
        $this->bloodgroup_id = null;
        $this->email = null;
        $this->mobile = null;
        $this->religion_id = null;
        $this->occupation_id = null;
        $this->address = null;
        $this->pincode = null;
        $this->nationality_id = null;
        $this->area = '0';
        $this->father_name = null;
        $this->relation_id = null;
        $this->mother_name = null;
        $this->id_type_id = null;
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

    //setting error -if id_type selected and identification_no is empty


    public function render()
    {
        //for current UMR
        $nextUMR = $this->registrationNo();
        return view('livewire.patient.new-patient-registration', ['nextUMR' => $nextUMR])->extends('layouts.admin')->section('content');
    }
}

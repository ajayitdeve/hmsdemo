<?php

namespace App\Http\Livewire\RegistrationWithConsultation;

use App\Models\HealthCoordinator;
use App\Models\Other;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Unit;
use App\Models\Staff;
use App\Models\Title;
use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Patient;
use Livewire\Component;
use App\Models\Hospital;
use App\Models\Referral;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\VisitType;
use App\Models\Bloodgroup;
use App\Models\Occupation;
use App\Models\Nationality;
use App\Models\PatientType;
use App\Models\PatientVisit;
use App\Models\ConsultationCharge;
use App\Traits\PatientRegistration;
use App\Models\DepartmentConsultationFee;
use App\Models\IdType;
use App\Models\User;
use App\Models\Village;

class RegistrationWithConsultationMaster extends Component
{
    use PatientRegistration;
    //for state city dropdown
    public $villages = [], $titles = [], $religions = [], $occupations = [], $nationalities = [], $relations = [], $genders = [], $maritals = [], $bloodgroups = [], $patienttypes = [], $age;
    public $title_id, $religion_id, $occupation_id, $nationality_id, $area = '0', $relation_id, $gender_id, $marital_id, $bloodgroup_id;
    public $village_id, $registration_no, $registration_date, $patient_type_id;
    public $name, $dob, $email, $mobile, $address;
    public $pincode, $father_name, $mother_name, $rawage;
    //for referral
    public $referrals = [], $referralmenus = [], $referralmenu_id, $referrable_type, $referralmenuname = '';
    public $referral_id;
    public $defaultState;
    public $village_text;
    //for identification no
    public $identification_no, $id_type_id, $idTypes = [];
    //for foc
    public $foc = false, $users = [], $foc_by_id;
    //for consultation
    public $search = "", $visittypes = [], $units = [], $departments = [];
    public $visit_type_id, $unit_id, $department_id, $user;
    public $patient_id, $fee = null, $description;
    //remarks
    public $remarks;
    public $department_consultation_fee;
    public $cities = [];

    public $ageError = '';

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
        //for consultation
        $this->user = Auth()->user();
        $this->referrals = Referral::get();
        $this->visittypes = VisitType::get();
        //   $this->units = Unit::get();
        // $this->departments = Department::where('is_medical',1)->get();
        //only those department whose fee is set
        $this->departments = DepartmentConsultationFee::where('is_active', 1)->get();

        $this->users = User::get();
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
            // 'country_id' => 'required',
            'title_id' => 'required',
            'gender_id' => 'required',
            'marital_id' => 'required',
            'religion_id' => 'required',
            'occupation_id' => 'required',
            'nationality_id' => 'required',
            'area' => 'required',
            'relation_id' => 'required',
            //validation for consultation
            'unit_id' => 'required',
            'department_id' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
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

    public function stateChanged()
    {
        if ($this->state_id != -1) {
            $this->cities = City::where('state_id', $this->state_id)->get();
        }
    }
    //end of city state cascade

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
            //'referral_id' => $this->referral_id,
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
            'remarks' => $this->remarks,
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
                //now save consultation
                //1st- get id of patient
                $patientId = $ref->id;
                //get patient by id
                $newPatient = Patient::find($patientId);
                $newPatientVisitId = $this->saveConsultation($newPatient);
                if ($newPatientVisitId) {
                    //redirect to print
                    $this->resetInput();

                    return to_route('admin.patient.print-receipt', $newPatientVisitId);
                }
            }
        } else {
            session()->flash('message', 'Something went wront ! Try Again');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
    }
    public function saveConsultation(Patient $patient)
    {
        $patientvisit = new PatientVisit;
        $patientvisit->visit_no = $this->patientVisitNo();
        $patientvisit->visit_date = date('Y-m-d');
        $patientvisit->visit_type = 1; //paid
        $patientvisit->description = $this->description;
        $patientvisit->patient_id = $patient->id;
        $patientvisit->department_id = $this->department_id;
        $patientvisit->unit_id = $this->unit_id;
        $patientvisit->doctor_id = null;
        //$patientvisit->fee = 0.0;
        //there is no need to check visit_type in registration with consultatins .. it is obvios that the patient is comming first time
        $patientvisit->fee = $this->foc == true ? 0 : $this->department_consultation_fee;
        $patientvisit->foc = $this->foc == true ? true : null;
        $patientvisit->discount = $this->foc == true ? $this->department_consultation_fee :  0;
        $patientvisit->created_by_id = $this->user->id;
        $patientvisit->visit_type_id = $this->visit_type_id;
        $consultation = $patientvisit->save();
        //insert consultation charges
        if ($consultation) {
            ConsultationCharge::create([
                'patient_id' => $patient->id,
                'patient_visit_id' => $patientvisit->id,
                // 'amount' => $this->department_consultation_fee,
                'received_by_id' => $this->user->id,
                //for foc
                'amount' => $this->foc == true ? 0 : $this->department_consultation_fee,
                'foc_by_id' => $this->foc == true ? $this->foc_by_id : null,
                'foc' => $this->foc == true ? true : null
            ]);
        }
        $patientvisit->save();
        return $patientvisit->id;
    }

    protected function patientVisitNo(): string
    {
        $maxId = PatientVisit::max('id');
        $registrationNo = 'OPD' . date('y') . date('m') . ($maxId + 1);
        return $registrationNo;
    }
    //to check visit_type paid or fee

    public function department_changed()
    {
        $this->units = Unit::where('department_id', $this->department_id)->get();
        //setting initial unit_id value when department changed
        $temp = Unit::where('department_id', $this->department_id)->first();
        if ($temp) {
            $this->unit_id = $temp?->id;
        }
        //end of initial setup
        $consultationFeeByDepartment = DepartmentConsultationFee::where('department_id', $this->department_id)->where('is_active', 1)->orderBy('id', 'DESC')->first();
        if ($consultationFeeByDepartment) {
            $this->department_consultation_fee = $consultationFeeByDepartment?->fee;
        }

        // $this->checkVisitType($this->patient)?$this->isVisitFree=false:$this->isVisitFree=true;
        //dd($this->isVisitFree);
    }
    public function resetInput()
    {
        $this->referral_id = null;
        $this->village_id = null;
        $this->village_text = null;
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
    public function render()
    {
        $nextUMR = $this->registrationNo();
        return view('livewire.registration-with-consultation.registration-with-consultation-master', ['nextUMR' => $nextUMR])->extends('layouts.admin')->section('content');
    }
}

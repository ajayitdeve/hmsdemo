<?php

namespace App\Http\Livewire\Patient;

use App\Models\ConsultationCharge;
use App\Models\Department;
use App\Models\DepartmentConsultationFee;
use App\Models\Patient;
use App\Models\PatientVisit;
use App\Models\Referral;
use App\Models\Unit;
use App\Models\User;
use App\Models\VisitType;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PatientList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = "", $referrals = [], $visittypes = [], $units = [], $departments = [];
    public $patient_type_id, $referral_id, $visit_type_id, $unit_id,  $department_id, $user;
    public $patient_id, $fee = null, $description, $isDuplicateConsultation = false;
    public $patient;
    //wire:model fields
    public $name, $registration_no, $age, $address, $city, $pincode, $state, $relation_name, $father_name, $mother_name;
    public $department_consultation_fee = "0.0", $isVisitFree = false;
    //for foc
    public $foc = false, $users = [], $foc_by_id;
    public $departmentId = null;

    public function mount()
    {
        $this->user = Auth()->user();
        $this->referrals = Referral::get();
        $this->visittypes = VisitType::get();
        $this->units = Unit::get();
        // $this->departments = Department::where('is_medical',1)->get();
        //only those department whose fee is set
        $this->departments = DepartmentConsultationFee::get();

        //for foc
        $this->users = User::get();
    }
    public function rules()
    {
        return ([

            'department_id' => 'required',
            'unit_id' => 'required',

        ]);
    }

    public function department_changed()
    {
        $this->units = Unit::where('department_id', $this->department_id)->get();
        $consultationFeeByDepartment = DepartmentConsultationFee::where('department_id', $this->department_id)->first();

        $this->department_consultation_fee = $consultationFeeByDepartment->fee;
        $this->checkVisitType($this->patient) ? $this->isVisitFree = false : $this->isVisitFree = true;
        //dd($this->isVisitFree);


    }
    public function bookConsultation($patient_id)
    {
        $this->isDuplicateConsultation = false;
        $this->patient_id = $patient_id;
        $patient = Patient::where('id', $patient_id)->first();
        //binding model
        $this->name = $patient->name;
        $this->age = $patient->age;
        $this->registration_no = $patient->registration_no;
        $this->address = $patient->address;
        // $this->city=$patient->city->name;
        // $this->state=$patient->state->name;
        $this->pincode = $patient->pincode;
        $this->relation_name = $patient->relation->name;
        $this->father_name = $patient->father_name;
        $this->mother_name = $patient->mother_name;

        $this->patient_type_id = $patient->patient_type_id;
        $this->patient = $patient;
        $temp = $patient->patientVisits()->orderBy('id', 'desc')->first();
        $this->departmentId = $temp->department_id;
    }

    public function saveConsultation()
    {
        //dd($this->checkVisitType($this->patient));
        $count = PatientVisit::where('patient_id', $this->patient_id)->where('visit_date', date('Y-m-d'))->count();
        if ($count) {
            $this->duplicateVisitError = "Duplicate Consultation Error";
            $this->referral_id = null;
            $this->visit_type_id = null;
            $this->doctor_department_id = null;
            $this->unit_id = null;
            $this->isDuplicateConsultation = true;
        } else {
            $validatedData = $this->validate();
            $patientvisit = new PatientVisit;
            $patientvisit->visit_no = $this->patientVisitNo();
            $patientvisit->visit_date = date('Y-m-d');

            $patientvisit->visit_type = $this->checkVisitType($this->patient);
            $patientvisit->description = 'Description';
            $patientvisit->patient_id = $this->patient->id;
            $patientvisit->department_id = $this->department_id;
            $patientvisit->unit_id = $this->unit_id;
            $patientvisit->doctor_id = null;
            $patientvisit->fee = $this->foc == true ? 0 : ($this->checkVisitType($this->patient) ? $this->department_consultation_fee : 0.0);
            $patientvisit->foc = $this->foc == true ? true : null;
            $patientvisit->discount = $this->foc == true ? ($this->checkVisitType($this->patient) ? $this->department_consultation_fee : 0.0) :  0;
            $patientvisit->created_by_id = $this->user->id;
            $patientvisit->visit_type_id = $this->visit_type_id;
            $consultation = $patientvisit->save();
            //insert consultation charges
            if ($consultation) {
                ConsultationCharge::create([
                    'patient_id' => $this->patient_id,
                    'patient_visit_id' => $patientvisit->id,
                    // 'amount'=>$this->department_consultation_fee,
                    'received_by_id' => $this->user->id,
                    //for foc
                    'amount' => $this->foc == true ? 0 : ($this->checkVisitType($this->patient) ? $this->department_consultation_fee : 0.0),
                    'foc_by_id' => $this->foc == true ? $this->foc_by_id : null,
                    'foc' => $this->foc == true ? true : null
                ]);
            }
            // return "success";
            session()->flash('message', 'Consultation Booked Successfully.');
            $this->dispatchBrowserEvent('close-modal');
        }
    }


    protected function patientVisitNo(): string
    {
        $maxId = PatientVisit::max('id');
        $registrationNo = 'OPD' . date('y') . date('m') . ($maxId + 1);
        return $registrationNo;
    }
    //to check visit_type paid or fee
    public function checkVisitType(Patient $patient)
    {
        $freeConsulatationDuration = 15;
        // $visittype=null;//1 Paid  0 free
        //first chek : is patient has any VisitType
        $visitCount = PatientVisit::where('patient_id', $patient->id)->count();

        if ($visitCount === 0) {
            return 1;
        } else {
            //get the last visit where visit_type=1(paid)
            $tempVisitType = PatientVisit::where('patient_id', $patient->id)->where('visit_type', 1)->get();
            $maxVisitTypeId = $tempVisitType->max('id');
            //$maxVisitType=$tempVisitType->where('id',$maxVisitTypeId)->first();
            $latestVisitDate = PatientVisit::where('id', $maxVisitTypeId)->first('visit_date');
            $latestVisitDate = Carbon::parse($latestVisitDate->visit_date);

            //check if duplicate visit on same date


            $this->duplicateVisitError = null;
            // return $latestVisitDate;
            $lastFreeConsulatationDate = $latestVisitDate->addDays($freeConsulatationDuration);
            // return $lastFreeConsulatationDate->format('Y-m-d');
            //  if(Carbon::now()->addDays(10)->gt($lastFreeConsulatationDate)){
            if (Carbon::now()->gt($lastFreeConsulatationDate)) {
                //return 'greater';
                return 1;
            } else {
                //return 'less';
                return 0;
            }
        }
    }
    public function closeModal()
    {
        $this->resetExcept(['users', 'departments', 'department_id']);
    }
    public function resetInput() {}
    public function render()
    {

        $patients = Patient::orderBy('id', 'DESC')->get();
        return view('livewire.patient.patient-list', ['patients' => $patients])->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
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


class Revisit extends Component
{
    public $umr, $name, $doctor_name = null, $doctor_department, $doctor_unit;
    public $patientVisit, $patient;
    public $user, $referrals = [], $visittypes = [], $units = [], $departments = [], $users = [];
    public $department_consultation_fee, $isVisitFree, $isDuplicateConsultation;
    public $patient_id, $age, $registration_no, $address, $pincode, $relation_name, $father_name, $mother_name, $patient_type_id;
    public $duplicateVisitError, $referral_id, $visit_type_id, $doctor_department_id, $unit_id;

    public $department_id, $fee = null, $description, $state;
    //for foc
    public $foc = false, $foc_by_id;
    public $lastConsultationDepartmentId;
    public $id_type_id, $identification_no;
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

    public function umrChanged()
    {
        $patient = Patient::where('registration_no', $this->umr)->first();
        // dd($patient->patientvisits);
        $this->patient = $patient;
        $this->patient_id = $patient->id;
        $patient_visit_id = $patient->patientvisits->max('id');
        $patientVisit = PatientVisit::find($patient_visit_id);

        //dd($patientVisit);
        $this->patientVisit = $patientVisit;
        $this->bookConsultation($patient->id);
        //setting patient info
        $this->name = $patient->name;
        $this->doctor_name = $patientVisit->doctor != null ? $patientVisit->doctor->name : null;
        $this->doctor_department = $patientVisit->unit->department->name;
        $this->doctor_unit = $patientVisit->unit->name;

        $this->father_name = $patient->father_name;
        $this->address = $patient->address;
        $this->id_type_id = $patient->id_type_id;
        $this->identification_no = $patient->identification_no;

        //new code to set Department and unit selected
        $temp = $this->patient->patientVisits()->orderBy('id', 'desc')->first();
        $this->lastConsultationDepartmentId = $temp->department_id;
        $this->department_id = $this->lastConsultationDepartmentId;
        $this->units = Unit::where('department_id', $temp->department_id)->get();
        $this->unit_id = $temp->unit_id;
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
    }



    public function saveConsultation()
    {
        if ($this->checkIsNewPatient($this->patient->id)) {
            //dd("Paid Consultation");
            $this->unSetDuplicate();
            $this->paidConsultation();
        } else if ($this->checkIsWithinFreeDays($this->patient->id)) {
            if ($this->checkIsDepartmentSame($this->patient->id)) {
                if ($this->checkIsDuplicate($this->patient->id)) {
                    //  dd("Duplicate");
                    $this->setDuplicate();
                } else {
                    // dd("Free Visit");
                    $this->unSetDuplicate();
                    $this->freeConsultation();
                }
            } else {
                //dd("Paid Visit");
                $this->unSetDuplicate();
                $this->paidConsultation();
            }
        } else {
            // dd("Old Patient : after 15 days  ;; Means Paid Visit");
            $this->unSetDuplicate();
            $this->paidConsultation();
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

    //new functions
    public function checkIsNewPatient($patient_id)
    {
        $count = PatientVisit::where('patient_id', $this->patient_id)->count();
        if ($count == 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsDuplicate($patient_id)
    {
        $count = PatientVisit::where('patient_id', $this->patient_id)->where('visit_date', date('Y-m-d'))->count();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsDepartmentSame($patient_id)
    {
        $patientVisit = $this->patient->patientVisits()->orderBy('id', 'desc')->first();
        if ($this->department_id == $patientVisit->department_id) {
            return true;
        } else {
            return false;
        }
    }

    public function checkIsWithinFreeDays($patient_id)
    {
        $freeConsulatationDuration = 15;
        //get the last visit where visit_type=1(paid)
        $tempVisitType = PatientVisit::where('patient_id', $patient_id)->where('visit_type', 1)->get();
        $maxVisitTypeId = $tempVisitType->max('id');
        $latestVisitDate = PatientVisit::where('id', $maxVisitTypeId)->first('visit_date');
        $latestVisitDate = Carbon::parse($latestVisitDate->visit_date);

        $lastFreeConsulatationDate = $latestVisitDate->addDays($freeConsulatationDuration);
        if (Carbon::now()->gt($lastFreeConsulatationDate)) {
            //return 'greater';
            //return 1;
            return false;
        } else {
            return true;
        }
    }

    public function paidConsultation()
    {
        $validatedData = $this->validate();
        $patientvisit = new PatientVisit;
        $patientvisit->visit_no = $this->patientVisitNo();
        $patientvisit->visit_date = date('Y-m-d');

        $patientvisit->visit_type = 1;
        $patientvisit->description = $this->description;
        $patientvisit->patient_id = $this->patient->id;
        $patientvisit->department_id = $this->department_id;
        $patientvisit->unit_id = $this->unit_id;
        $patientvisit->doctor_id = null;
        $patientvisit->fee = $this->foc == true ? 0 : $this->department_consultation_fee;
        $patientvisit->foc = $this->foc == true ? true : null;
        $patientvisit->discount = $this->foc == true ? $this->department_consultation_fee :  0;
        $patientvisit->created_by_id = $this->user->id;
        $patientvisit->visit_type_id = $this->visit_type_id;
        $consultation = $patientvisit->save();
        //insert consultation charges
        if ($consultation) {
            ConsultationCharge::create([
                'patient_id' => $this->patient_id,
                'patient_visit_id' => $patientvisit->id,
                'received_by_id' => $this->user->id,
                //for foc
                'amount' => $this->foc == true ? 0 : $this->department_consultation_fee,
                'foc_by_id' => $this->foc == true ? $this->foc_by_id : null,
                'foc' => $this->foc == true ? true : null
            ]);
        }
        // return redirect()->route("admin.patient.consultation-list")->with("message", "Consultation Successfull");

        return to_route('admin.patient.print-receipt', $patientvisit->id);
    }

    public function freeConsultation()
    {
        $validatedData = $this->validate();
        $patientvisit = new PatientVisit;
        $patientvisit->visit_no = $this->patientVisitNo();
        $patientvisit->visit_date = date('Y-m-d');

        $patientvisit->visit_type = 0;
        $patientvisit->description = $this->description;
        $patientvisit->patient_id = $this->patient->id;
        $patientvisit->department_id = $this->department_id;
        $patientvisit->unit_id = $this->unit_id;
        $patientvisit->doctor_id = null;
        $patientvisit->fee = 0;
        $patientvisit->foc = null;
        $patientvisit->discount = 0;
        $patientvisit->created_by_id = $this->user->id;
        $patientvisit->visit_type_id = $this->visit_type_id;
        $consultation = $patientvisit->save();
        //insert consultation charges
        if ($consultation) {
            ConsultationCharge::create([
                'patient_id' => $this->patient_id,
                'patient_visit_id' => $patientvisit->id,
                'received_by_id' => $this->user->id,
                //for foc
                'amount' => 0,
                'foc_by_id' => null,
                'foc' => null
            ]);
        }
        // return redirect()->route("admin.patient.consultation-list")->with("message", "Consultation Successfull");

        return to_route('admin.patient.print-receipt', $patientvisit->id);
    }

    public function setDuplicate()
    {
        $this->duplicateVisitError = "Duplicate Consultation Error";
        $this->isDuplicateConsultation = true;
    }
    public function unSetDuplicate()
    {
        $this->duplicateVisitError = null;
        $this->isDuplicateConsultation = false;
    }
    //end of new functions
    public function render()
    {
        return view('livewire.patient.revisit')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Refer;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Refer;
use App\Models\Doctor;
use Livewire\Component;
use App\Models\Department;
use App\Models\PatientVisit;
use Illuminate\Support\Facades\Auth;

class ReferOpdPatient extends Component
{
    public $patient_visit_id, $patientVisit, $units = [], $departments = [], $doctors = [];
    public $patient_id, $department_id, $unit_id, $doctor_id, $refer_at, $remarks, $created_by_id;
    public $isReferSame = false;
    public $latestPatientRefer;

    public function mount()
    {
        $this->patientVisit = null;
        $this->latestPatientRefer = null;
        $this->departments = Department::get();
        $this->units = Unit::get();
        $this->doctors = Doctor::get();
    }

    protected $rules = [
        'department_id' => 'required',
        'unit_id' => 'required',
        'doctor_id' => 'required',
        'remarks' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function departmentChanged()
    {
        if ($this->department_id) {
            $this->unit_id = null;
            $this->doctor_id = null;
            $this->units = Unit::where('department_id', $this->department_id)->get();
            $this->isReferSame();
        }
    }

    public function unitChanged()
    {
        if ($this->unit_id != null) {

            $this->doctor_id = null;
            $this->doctors = Doctor::where('unit_id', $this->unit_id)->get();
            $this->isReferSame();
            // dd($this->doctors);
        }
    }

    public function doctorChanged()
    {
        if ($this->doctor_id != null) {
            $this->isReferSame();
        }
    }

    public function referPatient($patient_visit_id)
    {
        $this->resetExcept(['departments', 'units', 'doctors']);

        $this->patient_visit_id = $patient_visit_id;
        $patientVisit = PatientVisit::find($patient_visit_id);
        $this->patientVisit = $patientVisit;
        // check if patient is not referred previously
        $patientRefers = Refer::where('patient_visit_id', $patient_visit_id)->get();
        // dd($patientRefers->count());
        if ($patientRefers->count() > 0) {

            $this->latestPatientRefer = Refer::where('patient_visit_id', $patient_visit_id)->latest()->first();
        }
        // dd($this->latestPatientRefer);
    }

    public function saveReferPatient()
    {
        $this->validate();

        $this->isReferSame(); //Checking Source and Destination is same
        //
        if (Refer::where('patient_visit_id', $this->patient_visit_id)->count() == 0) {
            if ($this->isReferSame == false) {
                Refer::create([
                    'patient_id' => $this->patientVisit?->patient_id,
                    'patient_visit_id' => $this->patientVisit?->id,
                    'department_id_from' => $this->patientVisit?->department_id,
                    'unit_id_from' => $this->patientVisit?->unit_id,
                    'doctor_id_from' => $this->patientVisit?->doctor_id,
                    'department_id_to' => $this->department_id,
                    'unit_id_to' => $this->unit_id,
                    'doctor_id_to' => $this->doctor_id,
                    'refer_at' => Carbon::now(),
                    'remarks' => $this->remarks,
                    'created_by_id' => Auth::user()?->id,
                ]);
                $this->changePatientVisit($this->patientVisit?->id);

                $this->resetExcept('departments', 'units', 'doctors');
                $this->dispatchBrowserEvent('close-modal');
                session()->flash('message', 'Patient Refer Successfully.');
            }
        } else if (Refer::where('patient_visit_id', $this->patient_visit_id)->count() > 0) {
            // dd('count >0');
            //in this case get department_id_from,unit_id_from,doctor_id_form fron last refer of patient
            //i.e $this->latestPatientRefer
            if ($this->isReferSame == false) {
                Refer::create([
                    'patient_id' => $this->patientVisit?->patient_id,
                    'patient_visit_id' => $this->patientVisit?->id,
                    'department_id_from' => $this->latestPatientRefer?->department_id_to,
                    'unit_id_from' => $this->latestPatientRefer?->unit_id_to,
                    'doctor_id_from' => $this->latestPatientRefer?->doctor_id_to,
                    'department_id_to' => $this->department_id,
                    'unit_id_to' => $this->unit_id,
                    'doctor_id_to' => $this->doctor_id,
                    'refer_at' => Carbon::now(),
                    'remarks' => $this->remarks,
                    'created_by_id' => Auth::user()?->id,
                ]);
                $this->changePatientVisit($this->patientVisit?->id);

                $this->resetExcept('departments', 'units', 'doctors');
                $this->dispatchBrowserEvent('close-modal');
                session()->flash('message', 'Patient Refer Successfully.');
            }
        }
    }

    public function isReferSame()
    {
        if ($this->latestPatientRefer == null) {
            $this->patientVisit?->department_id == $this->department_id && $this->patientVisit?->unit_id == $this->unit_id && $this->patientVisit?->doctor_id == $this->doctor_id ?  $this->isReferSame = true : $this->isReferSame = false;
        } else {
            $this->latestPatientRefer?->department_id_to == $this->department_id && $this->latestPatientRefer?->unit_id_to == $this->unit_id && $this->latestPatientRefer?->doctor_id_to == $this->doctor_id ? $this->isReferSame = true : $this->isReferSame = false;
        }
    }

    public function changePatientVisit($patient_visit_id)
    {
        PatientVisit::find($patient_visit_id)->update([
            'department_id' => $this->department_id,
            'unit_id' => $this->unit_id,
            'doctor_id' => $this->doctor_id,
        ]);
    }

    public function render()
    {
        $patientvisits = PatientVisit::orderBy('id', 'DESC')->get();
        return view('livewire.refer.refer-opd-patient', ['patientvisits' => $patientvisits])->extends('layouts.admin')->section('content');
    }
}

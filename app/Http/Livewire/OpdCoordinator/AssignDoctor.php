<?php

namespace App\Http\Livewire\OpdCoordinator;

use App\Models\Doctor;
use App\Models\Unit;
use Livewire\Component;

class AssignDoctor extends Component
{
    public $status;
    protected $queryString = ['status'];

    public $patient_visit_id, $patientVisit, $units = [], $departments = [], $doctors = [];
    public $visit_no, $visit_type, $visit_date, $visit_status, $description, $patient_id, $doctor_id, $department_id, $unit_id;

    public function mount()
    {
        $this->patientVisit = null;
        $this->departments = \App\Models\Department::get();
        // $this->units = \App\Models\Unit::get();
        // $this->doctors = \App\Models\Doctor::get();
    }

    public function departmentChanged()
    {
        if ($this->department_id != null) {
            $this->units = Unit::where('department_id', $this->department_id)->get();
        }
    }

    public function unitChanged()
    {
        if ($this->unit_id != null) {
            $this->doctors = Doctor::where('unit_id', $this->unit_id)->get();
            // dd($this->doctors);
        }
    }
    public function assignDoctor($patient_visit_id)
    {
        $patientVisit = \App\Models\PatientVisit::find($patient_visit_id);
        $this->patient_visit_id = $patient_visit_id;
        if ($patientVisit) {
            $this->patientVisit = $patientVisit;
            $this->visit_no = $patientVisit->visit_no;
            $this->visit_type = $patientVisit;
            $this->visit_date = $patientVisit->visit_date;
            $this->visit_status = $patientVisit->visit_status;
            $this->description = $patientVisit->description;
            $this->patient_id = $patientVisit->patient_id;
            $this->department_id = $patientVisit->department_id;
            $this->doctor_id = $patientVisit->doctor_id;
            $this->unit_id = $patientVisit->unit_id;

            $this->units = Unit::where('department_id', $this->department_id)->get();
            $this->doctors = Doctor::where('unit_id', $this->unit_id)->get();
        }
    }

    public function save()
    {
        \App\Models\PatientVisit::where('id', $this->patient_visit_id)->update(['department_id' => $this->department_id, 'doctor_id' => $this->doctor_id, 'unit_id' => $this->unit_id]);
        session()->flash('message', 'Doctor Assigned  Successfully.');
        $this->reset('visit_no', 'visit_type', 'visit_date', 'visit_status', 'description', 'patient_id', 'doctor_id', 'department_id', 'unit_id');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $patientvisits = \App\Models\PatientVisit::when($this->status && $this->status == "not_assign", function ($query, $status) {
            return $query->whereNull('doctor_id');
        })
            ->when($this->status && $this->status == "assign", function ($query, $status) {
                return $query->whereNotNull('doctor_id');
            })
            ->orderBy('id', 'DESC')
            ->get();

        return view('livewire.opd-coordinator.assign-doctor', ['patientvisits' => $patientvisits])->extends('layouts.admin')->section('content');
    }
}

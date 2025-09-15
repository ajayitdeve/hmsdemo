<?php

namespace App\Http\Livewire\Nurse\CrossConsultation;

use App\Models\Department;
use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\IpdCrossConsultation;
use App\Traits\NurseDepartment;
use Livewire\Component;

class CrossConsultation extends Component
{
    use NurseDepartment;

    public $ipd_code, $ipd;
    public $umr, $patient_name, $admn_no, $doctor_name;

    public $department_id, $department_code, $consultant_id, $consultant_code, $priority = "Routine", $remarks;
    public $departments = [], $doctors = [];
    public $priorities = [
        "Routine",
        "Urgent",
        "Semi Urgent",
    ];
    public $cross_consultant_list;

    public function mount($ipd_code)
    {
        $this->ipd_code = $ipd_code;
        $this->checkNurseStationSession();

        $ipd = Ipd::with(
            [
                "bed",
                "room" => function ($query) {
                    $query->where("nurse_station_id", session()->get("nurse_station_id"));
                },
                "patient_visit" => function ($query) {
                    $query->with(['doctor']);
                },
                "patient" => function ($query) {
                    $query->with(['gender']);
                }
            ]
        )
            ->whereHas("room", function ($query) {
                $query->where("nurse_station_id", session()->get("nurse_station_id"));
            })
            ->where("ipdcode", $this->ipd_code)
            ->first();

        if ($ipd) {
            $this->ipd = $ipd;

            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_name = $ipd?->patient?->name;
            $this->admn_no = $ipd->ipdcode;
            $this->doctor_name = $ipd?->patient_visit?->doctor?->name;

            $this->departments = Department::get();
            $this->doctors = Doctor::get();
            $this->getCrossConsultant();
        }
    }

    public function changedDepartment()
    {
        $department = Department::find($this->department_id);
        if ($department) {
            $this->department_code = $department->code;
            $this->doctors = Doctor::where("department_id", $this->department_id)->get();

            $this->reset(["consultant_id", "consultant_code"]);
        } else {
            $this->reset(["department_code", "consultant_code"]);
        }
    }

    public function changedConsultant()
    {
        $doctor = Doctor::find($this->consultant_id);
        if ($doctor) {
            $this->department_id = $doctor->department_id;
            $this->department_code = $doctor?->department?->code;
            $this->consultant_code = $doctor->code;
        } else {
            $this->reset(["department_id", "department_code", "consultant_code"]);
        }
    }

    public function save()
    {
        $this->validate([
            "department_id" => "required",
            "consultant_id" => "required",
            "remarks" => "",
        ]);

        IpdCrossConsultation::create([
            'ipd_id' => $this->ipd?->id,
            'patient_id' => $this->ipd?->patient?->id,
            'department_id' => $this->department_id,
            'doctor_id' => $this->consultant_id,
            'priority' => $this->priority,
            'remarks' => $this->remarks,
            'nurse_station_id' => session()->get("nurse_station_id"),
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Cross consultant added successfully.');

        $this->reset(["priority", "department_id", "department_code", "consultant_id", "consultant_code"]);
        $this->getCrossConsultant();
    }

    public function getCrossConsultant()
    {
        $this->cross_consultant_list = IpdCrossConsultation::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->where("nurse_station_id", session()->get("nurse_station_id"))
            ->get();
    }

    public function render()
    {
        return view('livewire.nurse.cross-consultation.cross-consultation')->extends('layouts.admin')->section('content');
    }
}

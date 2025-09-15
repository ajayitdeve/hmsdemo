<?php

namespace App\Http\Livewire\Nurse\Discharge;

use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\PatientDischarge;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class ToBeDischarge extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $status, $admn_no, $patient_type, $corporate_name, $admn_date, $ward, $room, $bed;
    public $admitted_doctor_code, $admitted_doctor_name, $admitted_doctor_department;
    public $discharge_no, $doctor_id, $doctor_code, $department, $discharge_date_time, $review_date, $remarks;

    public $doctors = [];

    public function generateCode()
    {
        $count = PatientDischarge::max("id");
        return "TDN" . ($count + 1);
    }

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
            $this->status = "Not Approved";
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->admitted_doctor_code = $ipd?->patient_visit?->doctor?->code;
            $this->admitted_doctor_name = $ipd?->patient_visit?->doctor?->name;
            $this->admitted_doctor_department = $ipd?->patient_visit?->doctor?->department?->name;
            $this->discharge_date_time = date("Y-m-d H:i");
            $this->review_date = date("Y-m-d");

            $this->discharge_no = $this->generateCode();

            $this->doctors = Doctor::get();
        }
    }

    public function changedDoctor()
    {
        $doctor = Doctor::where("id", $this->doctor_id)->first();
        if ($doctor) {
            $this->doctor_code = $doctor->code;
            $this->department = $doctor?->department?->name;
        } else {
            $this->doctor_code = null;
            $this->department = null;
        }
    }

    public function save()
    {
        $this->validate([
            'doctor_id' => 'required',
            'doctor_code' => 'required',
            'discharge_date_time' => 'required',
            'review_date' => 'required',
            'remarks' => '',
        ]);

        $discharge = PatientDischarge::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->first();

        if ($discharge) {
            session()->flash("error", "Patient already discharged!");
            return;
        }

        PatientDischarge::create([
            'ipd_id' => $this->ipd?->id,
            'patient_id' => $this->ipd?->patient?->id,
            'code' => $this->generateCode(),
            'doctor_id' => $this->doctor_id,
            'discharge_date_time' => $this->discharge_date_time,
            'review_date' => $this->review_date,
            'remarks' => $this->remarks,
            'nurse_station_id' => session()->get('nurse_station_id'),
            'created_by_id' => auth()->user()?->id,
        ]);

        // $ipd = Ipd::where("ipdcode", $this->ipd_code)->first();
        // if ($ipd) {
        //     $ipd->status = "Discharge";
        //     $ipd->save();
        // }

        session()->flash('success', 'Discharge details saved successfully.');

        $this->reset(["doctor_id", "doctor_code", "department", "remarks"]);

        $this->discharge_date_time = date("Y-m-d H:i");
        $this->review_date = date("Y-m-d");
        $this->discharge_no = $this->generateCode();
    }

    public function render()
    {
        return view('livewire.nurse.discharge.to-be-discharge')->extends('layouts.admin')->section('content');
    }
}

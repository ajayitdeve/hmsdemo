<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DietSheet extends Component
{
    use NurseDepartment;

    public $ipd_code, $ipd, $bg_color;
    public $diet_indent_no, $diet_indent_date, $from_department_code, $from_department_name, $admn_no, $admn_date, $umr, $patient_name, $status, $doctor_code, $doctor_name, $ward, $room, $bed, $corporate_name, $patient_type;
    public $diet_sheet_list = [];

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

            $this->diet_indent_no = "DIS1";
            $this->diet_indent_date = date("Y-m-d");
            $this->from_department_code = $ipd->room?->nurseStation?->code;
            $this->from_department_name = $ipd->room?->nurseStation?->name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_name = $ipd?->patient?->name;
            $this->status = "Not Approved";
            $this->doctor_code = $ipd?->patient_visit?->doctor?->code;
            $this->doctor_name = $ipd?->patient_visit?->doctor?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;
        }
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.diet-sheet')->extends('layouts.admin')->section('content');
    }
}

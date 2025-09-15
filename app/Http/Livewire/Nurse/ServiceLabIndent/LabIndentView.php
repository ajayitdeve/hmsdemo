<?php

namespace App\Http\Livewire\Nurse\ServiceLabIndent;

use App\Models\IpLabIndent;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class LabIndentView extends Component
{
    use NurseDepartment;

    public $bg_color;
    public $umr, $patient_name, $status, $patient_type, $age, $gender, $ward, $room, $bed, $admn_no, $admn_date, $consultant, $corporate_name;
    public $indent_no, $indent_date, $consultant_code, $consultant_name, $remarks, $instructions, $clinical_summary_diagnosis;

    public $payableAmount = 0, $arrCart = [];
    public $is_corporate_service = false;

    public function mount($indent_id)
    {
        $this->checkNurseStationSession();

        $lab_indent = IpLabIndent::where('id', $indent_id)->where("nurse_station_id", session()->get("nurse_station_id"))->first();

        if ($lab_indent) {
            $this->umr = $lab_indent->ipd?->patient?->registration_no;
            $this->patient_name = $lab_indent->ipd?->patient?->name;
            $this->status = $lab_indent->status;
            $this->patient_type = $lab_indent->ipd?->patient?->patienttype->name;
            $this->age = Carbon::parse($lab_indent->ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $lab_indent->ipd?->patient?->gender?->name;
            $this->ward = $lab_indent->ipd?->ward?->name;
            $this->room = $lab_indent->ipd?->room?->name;
            $this->bed = $lab_indent->ipd?->bed?->display_name;
            $this->admn_no = $lab_indent->ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($lab_indent->ipd?->created_at));
            $this->consultant = $lab_indent->ipd?->patient_visit?->doctor?->name;

            $this->corporate_name = $lab_indent->ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $lab_indent->ipd?->corporate_registration?->organization?->color;
            $this->is_corporate_service = $lab_indent->ipd?->corporate_registration ? true : false;

            $this->indent_no = $lab_indent->code;
            $this->indent_date = date("Y-m-d", strtotime($lab_indent->created_at));
            $this->consultant_code = $lab_indent->ipd?->patient_visit?->doctor?->code;
            $this->consultant_name = $lab_indent->ipd?->patient_visit?->doctor?->name;
            $this->remarks = $lab_indent->remarks;
            $this->instructions = $lab_indent->instructions;
            $this->clinical_summary_diagnosis = $lab_indent->clinical_summary_diagnosis;

            $this->arrCart = $lab_indent->indent_items;
            $this->payableAmount = $lab_indent->indent_items()->sum('total');
        }
    }

    public function render()
    {
        return view('livewire.nurse.service-lab-indent.lab-indent-view')->extends('layouts.admin')->section('content');
    }
}

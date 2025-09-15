<?php

namespace App\Http\Livewire\Nurse\Discharge;

use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\PatientDischargeProcessStatus;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DischargeProcessStatus extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $gender, $status, $admn_no, $patient_type, $corporate_name, $admn_date, $ward, $room, $bed;
    public $doctor_id, $doctor_code, $place, $notes, $remarks, $time, $is_return_pharmacy = "0", $is_amubulance = "0";
    public $doctors = [];

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
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;

            $this->doctor_id = $ipd?->patient_visit?->doctor?->id;
            $this->doctor_code = $ipd?->patient_visit?->doctor?->code;
            $this->time = date("H:i");

            $this->doctors = Doctor::get();
            $this->getDischargeProcessStatus();
        }
    }

    public function getDischargeProcessStatus()
    {
        $discharge_process_status = PatientDischargeProcessStatus::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->first();

        if ($discharge_process_status) {
            $this->doctor_code = $discharge_process_status?->doctor?->code;
            $this->doctor_id = $discharge_process_status->doctor_id;
            $this->place = $discharge_process_status->place;
            $this->time = date("H:i", strtotime($discharge_process_status->time));
            $this->is_return_pharmacy = $discharge_process_status->is_return_pharmacy;
            $this->is_amubulance = $discharge_process_status->is_amubulance;
            $this->notes = $discharge_process_status->notes;
            $this->remarks = $discharge_process_status->remarks;
        }
    }

    public function changedDoctor()
    {
        $doctor = Doctor::where("id", $this->doctor_id)->first();
        if ($doctor) {
            $this->doctor_code = $doctor->code;
        } else {
            $this->doctor_code = null;
        }
    }

    public function save()
    {
        $this->validate([
            'doctor_id' => 'required',
            'time' => 'required',
            'is_return_pharmacy' => 'required',
            'is_amubulance' => 'required',
        ]);

        $discharge_process_status = PatientDischargeProcessStatus::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->first();

        if ($discharge_process_status) {
            $discharge_process_status->doctor_id = $this->doctor_id;
            $discharge_process_status->place = $this->place;
            $discharge_process_status->time = date("H:i:s", strtotime($this->time));
            $discharge_process_status->is_return_pharmacy = $this->is_return_pharmacy;
            $discharge_process_status->is_amubulance = $this->is_amubulance;
            $discharge_process_status->notes = $this->notes;
            $discharge_process_status->remarks = $this->remarks;
            $discharge_process_status->save();
        } else {
            PatientDischargeProcessStatus::create([
                "ipd_id" => $this->ipd?->id,
                "patient_id" => $this->ipd?->patient?->id,
                'doctor_id' => $this->doctor_id,
                'place' => $this->place,
                'time' => date("H:i:s", strtotime($this->time)),
                'is_return_pharmacy' => $this->is_return_pharmacy,
                'is_amubulance' => $this->is_amubulance,
                'notes' => $this->notes,
                'remarks' => $this->remarks,
                'nurse_station_id' => session()->get('nurse_station_id'),
                'created_by_id' => auth()->user()?->id,
            ]);
        }

        session()->flash('success', 'Discharge process status saved successfully.');

        $this->getDischargeProcessStatus();
    }

    public function render()
    {
        return view('livewire.nurse.discharge.discharge-process-status')->extends('layouts.admin')->section('content');
    }
}

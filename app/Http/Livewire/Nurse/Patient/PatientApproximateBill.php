<?php

namespace App\Http\Livewire\Nurse\Patient;

use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Livewire\Component;

class PatientApproximateBill extends Component
{
    use NurseDepartment;

    public $ipd, $ipd_code;
    public $umr, $patient_name, $admn_no, $consultant;

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
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
        }
    }

    public function render()
    {
        return view('livewire.nurse.patient.patient-approximate-bill')->extends('layouts.admin')->section('content');
    }
}

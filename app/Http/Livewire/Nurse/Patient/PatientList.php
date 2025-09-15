<?php

namespace App\Http\Livewire\Nurse\Patient;

use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Livewire\Component;
use Livewire\WithPagination;

class PatientList extends Component
{
    use WithPagination, NurseDepartment;
    protected $paginationTheme = "bootstrap";

    public $search;

    public function mount()
    {
        $this->checkNurseStationSession();
    }

    public function render()
    {
        $ipds = Ipd::with(
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
            // ->whereHas("patient_visit", function ($query) {
            //     $query->whereHas("doctor");
            // })
            ->whereHas("room", function ($query) {
                $query->where("nurse_station_id", session()->get("nurse_station_id"));
            })
            ->where(function ($query) {
                $query->where('ipdcode', 'like', "%{$this->search}%")
                    ->orWhereHas('patient', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%")
                            ->orWhere('dob', 'like', "%{$this->search}%");
                    })
                    ->orWhereHas('patient_visit.doctor', function ($q) {
                        $q->where('name', 'like', "%{$this->search}%");
                    });
            })
            ->latest()
            ->paginate(20);


        return view('livewire.nurse.patient.patient-list', compact('ipds'))->extends('layouts.admin')->section('content');
    }
}

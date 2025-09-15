<?php

namespace App\Http\Livewire\Nurse\Patient;

use App\Models\IntakeOutputEntry;
use App\Models\Ipd\Ipd;
use App\Models\Note;
use App\Models\Vital;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class PatientMedicalDetails extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $admn_no, $patient_type, $consultant, $corporate_name;
    public $nurse_notes = [];
    public $vitals = [];
    public $intake_output_list = [];

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
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->admn_no = $ipd->ipdcode;
            $this->gender = $ipd?->patient?->gender?->name;
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->nurse_notes = Note::where('ipd_id', $this->ipd?->id)
                ->where('patient_id', $this->ipd?->patient?->id)
                ->latest()
                ->get();

            $this->vitals = Vital::where("ipd_id", $this->ipd?->id)
                ->where("patient_id", $this->ipd?->patient?->id)
                ->latest()
                ->get();

            $this->intake_output_list = IntakeOutputEntry::where("ipd_id", $this->ipd?->id)
                ->where("patient_id", $this->ipd?->patient?->id)
                ->orderBy("date_time", "desc")
                ->get();;
        }
    }

    public function render()
    {
        return view('livewire.nurse.patient.patient-medical-details')->extends('layouts.admin')->section('content');
    }
}

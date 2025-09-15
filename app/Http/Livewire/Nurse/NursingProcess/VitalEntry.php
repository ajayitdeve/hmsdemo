<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\Ipd\Ipd;
use App\Models\Vital;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class VitalEntry extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $patient_type, $status, $age, $gender, $admn_no, $admn_date, $consultant, $ward, $room, $bed, $corporate_name;

    public $date_time, $bp, $bp_unit = "mmHg", $temperature, $temperature_unit = "°F", $height, $height_unit = "cm", $weight, $weight_unit = "kg", $pulse, $pulse_unit = "bpm", $respiration, $respiration_unit = "breaths/min", $cvp, $cvp_unit = "mmHg", $saturation, $saturation_unit = "%(SpO₂)";

    public $temperature_units = [
        "°C",
        "°F",
    ];
    public $height_units = [
        'cm',
        'inch',
        'feet',
    ];
    public $weight_units = [
        'kg',
        'gm',
    ];

    public $vitals = [];

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
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->date_time = date("Y-m-d H:i");
            $this->getVital();
        }
    }

    public function rules(): array
    {
        return [
            'date_time' => 'required',
            'bp' => '',
            'temperature' => 'nullable|numeric|min:1|max:150',
            'height' => 'nullable|min:1|max:250',
            'weight' => 'nullable|min:1|max:500',
            'pulse' => 'nullable|integer|min:30|max:200',
            'respiration' => 'nullable|integer|min:8|max:50',
            'cvp' => 'nullable|numeric|min:2|max:25',
            'saturation' => 'nullable|numeric|min:50|max:100',
        ];
    }

    public function save()
    {
        $this->validate();

        Vital::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "date_time" => date("Y-m-d H:i:s", strtotime($this->date_time)),
            "bp" => $this->bp,
            "bp_unit" => $this->bp_unit,
            "temperature" => $this->temperature,
            "temperature_unit" => $this->temperature_unit,
            "height" => $this->height,
            "height_unit" => $this->height_unit,
            "weight" => $this->weight,
            "weight_unit" => $this->weight_unit,
            "pulse" => $this->pulse,
            "pulse_unit" => $this->pulse_unit,
            "respiration" => $this->respiration,
            "respiration_unit" => $this->respiration_unit,
            "cvp" => $this->cvp,
            "cvp_unit" => $this->cvp_unit,
            "saturation" => $this->saturation,
            "saturation_unit" => $this->saturation_unit,
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        session()->flash('message', 'Vital signs saved successfully.');

        $this->date_time = date("Y-m-d H:i");
        $this->getVital();

        $this->reset([
            "bp",
            "temperature",
            "height",
            "weight",
            "pulse",
            "respiration",
            "cvp",
            "saturation"
        ]);
    }

    public function getVital()
    {
        $this->vitals = Vital::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.vital-entry')->extends('layouts.admin')->section('content');
    }
}

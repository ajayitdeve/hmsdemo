<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\DietIndentEntry;
use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Illuminate\Http\Middleware\TrustProxies;
use Livewire\Component;

class DietIndent extends Component
{
    use NurseDepartment;

    public $ipd, $ipd_code;
    public $diet_indent_no, $admn_no, $umr, $patient_name, $diet_indent_date, $diet_indent_time, $height, $height_unit = "Cms", $weight, $weight_unit = "Kgs", $bmi, $diagnosis, $diet_type, $diet_category, $meal, $note;

    public $diet_types = [
        'Normal Diet',
        'Diabetic Diet',
        'Low Sodium Diet',
        'High Protein Diet',
        'Liquid Diet',
    ];
    public $diet_categories = [
        'Tea Coffee',
        'Breakfast',
        'Fruits',
        'Lunch',
        'Snack',
        'Dinner',
    ];

    public $diet_indent_list = [];

    public function generateDietIndentNo()
    {
        $count = DietIndentEntry::max("id");
        return "DT" . date('y') . date('m') . date('d') . ($count + 1);
    }

    public function getDietIndent()
    {
        $this->diet_indent_list = DietIndentEntry::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->where("nurse_station_id", session()->get("nurse_station_id"))
            ->latest()
            ->get();
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
            $this->admn_no = $ipd->ipdcode;

            $this->diet_indent_date = date("Y-m-d");
            $this->diet_indent_time = date("H:i");

            $this->diet_indent_no = $this->generateDietIndentNo();
            $this->getDietIndent();
        }
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['height', 'weight'])) {
            $this->calculateBmi();
        }
    }

    private function calculateBmi()
    {
        if ($this->height && $this->weight) {
            $heightInMeters = $this->height / 100;
            $this->bmi = round($this->weight / ($heightInMeters * $heightInMeters), 2);
        } else {
            $this->bmi = null;
        }
    }

    public function rules(): array
    {
        return [
            "diet_indent_no" => "required",
            "umr" => "required",
            "diet_indent_date" => "required|date",
            "diet_indent_time" => "required",
            "diet_type" => "required",
            "diet_category" => "required",
            "meal" => "required",
        ];
    }


    public function save()
    {
        $this->validate();

        DietIndentEntry::create([
            'ipd_id' => $this->ipd?->id,
            'patient_id' => $this->ipd?->patient?->id,
            'code' => $this->generateDietIndentNo(),
            'diet_indent_date' => date("Y-m-d", strtotime($this->diet_indent_date)),
            'diet_indent_time' => date("H:i:s", strtotime($this->diet_indent_time)),
            'height' => $this->height,
            'weight' => $this->weight,
            'bmi' => $this->bmi,
            'diagnosis' => $this->diagnosis,
            'diet_type' => $this->diet_type,
            'diet_category' => $this->diet_category,
            'meal' => $this->meal,
            'note' => $this->note,
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        $this->diet_indent_date = date("Y-m-d");
        $this->diet_indent_time = date("H:i");
        $this->getDietIndent();

        session()->flash('success', 'Diet Indent saved successfully.');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->diet_indent_no = $this->generateDietIndentNo();
        $this->height = null;
        $this->height_unit = "Cms";
        $this->weight = null;
        $this->weight_unit = "Kgs";
        $this->bmi = null;
        $this->diagnosis = null;
        $this->diet_type = null;
        $this->diet_category = null;
        $this->meal = null;
        $this->note = null;
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.diet-indent')->extends('layouts.admin')->section('content');
    }
}

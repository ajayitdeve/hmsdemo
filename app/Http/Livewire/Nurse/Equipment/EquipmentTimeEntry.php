<?php

namespace App\Http\Livewire\Nurse\Equipment;

use App\Models\Ipd\Ipd;
use App\Models\IpdEquipmentUsage;
use App\Models\IpdEquipmentUsageItem;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class EquipmentTimeEntry extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $status, $admn_no, $patient_type, $consultant, $corporate_name, $admn_date, $ward, $room, $bed;
    public $usage_no, $usage_date, $usage_id;

    public $arrCart = [];
    public $equipment_usage_list = [];

    public function rules()
    {
        return [
            'arrCart' => 'required',
            'arrCart.*.from_date_time' => 'required',
            'arrCart.*.to_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'arrCart.required' => 'Please add at least one equipment.',
            'arrCart.*.from_date_time.required' => 'From time is required for each entry.',
            'arrCart.*.to_date_time.required' => 'To time is required for each entry.',
        ];
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
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->usage_date = date("Y-m-d H:i");
            $this->equipment_usage_list = IpdEquipmentUsage::where("ipd_id", $this->ipd?->id)
                ->where("patient_id", $this->ipd?->patient?->id)
                ->where("nurse_station_id", session()->get("nurse_station_id"))
                ->latest()
                ->get();
        }
    }

    public function save()
    {
        $this->validate();

        foreach ($this->arrCart as $item) {
            IpdEquipmentUsageItem::where("id", $item['id'])
                ->where("ipd_equipment_usage_id", $this->usage_id)
                ->update([
                    "to_date_time" =>  date("Y-m-d H:i:s", strtotime($item["to_date_time"]))
                ]);
        }

        session()->flash('success', 'Equip time entry saved successfully.');
    }

    public function changedUsageNo()
    {
        $this->arrCart = [];
        $this->arrCart = IpdEquipmentUsageItem::with(['equipment_group', 'equipment'])->where("ipd_equipment_usage_id", $this->usage_id)
            ->latest()
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.nurse.equipment.equipment-time-entry')->extends('layouts.admin')->section('content');
    }
}

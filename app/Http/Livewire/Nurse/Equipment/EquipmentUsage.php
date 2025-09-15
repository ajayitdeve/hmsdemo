<?php

namespace App\Http\Livewire\Nurse\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentGroup;
use App\Models\Ipd\Ipd;
use App\Models\IpdEquipmentUsage;
use App\Models\IpdEquipmentUsageItem;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class EquipmentUsage extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $status, $admn_no, $patient_type, $consultant, $corporate_name, $admn_date, $ward, $room, $bed;
    public $usage_no, $usage_date;

    public $arrCart = [];
    public $equipment_usage_list = [];
    public $equipment_usage_items = [];

    public $equipment_groups = [];
    public $equipments = [];

    public function rules()
    {
        return [
            'arrCart.*.equipment_group_id' => 'required',
            'arrCart.*.equipment_id' => 'required',
            'arrCart.*.equipment_code' => 'required',
            'arrCart.*.from_date_time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'arrCart.*.equipment_group_id.required' => 'Equip group is required for each entry.',
            'arrCart.*.equipment_id.required' => 'Equip is required for each entry.',
            'arrCart.*.equipment_code.required' => 'Equip code is required for each entry.',
            'arrCart.*.from_date_time.required' => 'From time is required for each entry.',
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

            $this->usage_no = $this->generateCode();
            $this->usage_date = date("Y-m-d H:i");

            $this->equipment_groups = EquipmentGroup::all();
            $this->equipments[] = Equipment::all();

            $this->arrCart[] = array(
                "equipment_group_id" => "",
                "equipment_id" => "",
                "equipment_code" => "",
                "from_date_time" => date("Y-m-d H:i"),
            );

            $this->getEquipmentUsage();
        }
    }

    public function generateCode()
    {
        $count = IpdEquipmentUsage::max("id");
        return "EQU" . ($count + 1);
    }

    public function addRow()
    {
        $this->arrCart[] = array(
            "equipment_group_id" => "",
            "equipment_id" => "",
            "equipment_code" => "",
            "from_date_time" => date("Y-m-d H:i"),
        );

        $this->equipments[] = Equipment::all();
    }

    public function removeRow($index)
    {
        if (count($this->arrCart) == 1) {
            session()->flash('error', 'At least one row is required.');
            return;
        }

        unset($this->arrCart[$index]);
        unset($this->equipments[$index]);
    }

    public function equipmentGroupChanged($index)
    {
        $this->equipments[$index] = Equipment::where('equipment_group_id', $this->arrCart[$index]['equipment_group_id'])->get();
        $this->arrCart[$index]['equipment_id'] = '';
        $this->arrCart[$index]['equipment_code'] = '';
    }

    public function equipmentChanged($index)
    {
        $equipment = Equipment::find($this->arrCart[$index]['equipment_id']);
        $this->arrCart[$index]['equipment_group_id'] = $equipment->equipment_group_id;
        $this->arrCart[$index]['equipment_code'] = $equipment->code;
    }

    public function save()
    {
        $this->validate();

        $equipment_usage = IpdEquipmentUsage::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "code" => $this->generateCode(),
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp["ipd_equipment_usage_id"] = $equipment_usage->id;
            $temp["equipment_group_id"] = $item["equipment_group_id"];
            $temp["equipment_id"] = $item["equipment_id"];
            $temp["equipment_code"] = $item["equipment_code"];
            $temp["from_date_time"] = date("Y-m-d H:i:s", strtotime($item["from_date_time"]));
            $temp["to_date_time"] = null;
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');

            array_push($data, $temp);
        }

        IpdEquipmentUsageItem::insert($data);

        session()->flash('success', 'Equip usage saved successfully.');

        $this->reset(["arrCart", "equipments"]);

        $this->arrCart[] = array(
            "equipment_group_id" => "",
            "equipment_id" => "",
            "equipment_code" => "",
            "from_date_time" => date("Y-m-d H:i"),
        );

        $this->equipments[] = Equipment::all();

        $this->usage_no = $this->generateCode();
        $this->usage_date = date("Y-m-d H:i");
        $this->getEquipmentUsage();
    }

    public function getEquipmentUsage()
    {
        $this->equipment_usage_list = IpdEquipmentUsage::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->where("nurse_station_id", session()->get("nurse_station_id"))
            ->get();
    }

    public function getEquipmentUsageItemDetails($id)
    {
        $this->equipment_usage_items = [];
        $this->equipment_usage_items = IpdEquipmentUsageItem::where("ipd_equipment_usage_id", $id)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.nurse.equipment.equipment-usage')->extends('layouts.admin')->section('content');
    }
}

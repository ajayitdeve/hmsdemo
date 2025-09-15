<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\Abnormal;
use App\Models\AbnormalEntry as AbnormalEntryModel;
use App\Models\AbnormalEntryItem;
use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class AbnormalEntry extends Component
{
    use NurseDepartment;

    public $ipd_code, $ipd, $bg_color;
    public $umr, $patient_name, $patient_type, $status, $age, $gender, $admn_no, $admn_date, $consultant, $ward, $room, $bed, $corporate_name;
    public $abnormal_no, $abnormal_date;
    public $arrCart = [];

    public $abnormal_master = [];
    public $abnormal_list = [];
    public $abnormal_item_list = [];

    public function rules()
    {
        return [
            'arrCart.*.abnormal_id' => 'required',
            'arrCart.*.abnormal_code' => 'required',
            'arrCart.*.date_time' => 'required|date',
            'arrCart.*.temperature' => 'required',
            'arrCart.*.remarks' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'arrCart.*.abnormal_id.required' => 'Abnormal Name is required for each entry.',
            'arrCart.*.abnormal_code.required' => 'Abnormal code is required for each entry.',

            'arrCart.*.date_time.required' => 'Date and time are required for each entry.',
            'arrCart.*.date_time.date' => 'Date and time must be a valid date format.',

            'arrCart.*.temperature.required' => 'Temperature is required for each entry.',
        ];
    }

    public function generateCode()
    {
        $count = AbnormalEntryModel::max('id');
        return "ABN" . date('y') . date('m') . date('d') . ($count + 1);
    }

    public function getAbnormalList()
    {
        $this->abnormal_list = AbnormalEntryModel::where("ipd_id", $this->ipd?->id)
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

            $this->abnormal_no = $this->generateCode();
            $this->abnormal_date = date("Y-m-d");
            $this->abnormal_master = Abnormal::all();

            $this->getAbnormalList();

            $this->arrCart[] = array(
                "abnormal_id" => "",
                "abnormal_code" => "",
                "date_time" => date("Y-m-d H:i"),
                "temperature" => "",
                "remarks" => "",
            );
        }
    }

    public function addRow()
    {
        $this->arrCart[] = array(
            "abnormal_id" => "",
            "abnormal_code" => "",
            "date_time" => date("Y-m-d H:i"),
            "temperature" => "",
            "remarks" => "",
        );
    }

    public function removeRow($index)
    {
        if (count($this->arrCart) == 1) {
            session()->flash('error', 'At least one row is required.');
            return;
        }

        unset($this->arrCart[$index]);
    }

    public function abnormalChanged($index)
    {
        $abmormal = Abnormal::find($this->arrCart[$index]["abnormal_id"]);
        if ($abmormal) {
            $this->arrCart[$index]["abnormal_code"] = $abmormal->code;
        }
    }

    public function save()
    {
        $this->validate();

        $abnormal_entry = AbnormalEntryModel::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "code" => $this->generateCode(),
            "status" => $this->status,
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp["abnormal_entry_id"] = $abnormal_entry->id;
            $temp["abnormal_id"] = $item["abnormal_id"];
            $temp["date_time"] = date("Y-m-d H:i:s", strtotime($item["date_time"]));
            $temp["temperature"] = $item["temperature"];
            $temp["remarks"] = $item["remarks"];
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');

            array_push($data, $temp);
        }

        AbnormalEntryItem::insert($data);

        session()->flash('success', 'Abnormal entries saved successfully.');

        $this->reset(["arrCart"]);

        $this->arrCart[] = array(
            "abnormal_id" => "",
            "abnormal_code" => "",
            "date_time" => date("Y-m-d H:i"),
            "temperature" => "",
            "remarks" => "",
        );

        $this->abnormal_no = $this->generateCode();
        $this->abnormal_date = date("Y-m-d");
        $this->getAbnormalList();
    }

    public function getAbnormalItemDetails($id)
    {
        $this->abnormal_item_list = [];
        $this->abnormal_item_list = AbnormalEntryItem::where("abnormal_entry_id", $id)
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.abnormal-entry')->extends('layouts.admin')->section('content');
    }
}

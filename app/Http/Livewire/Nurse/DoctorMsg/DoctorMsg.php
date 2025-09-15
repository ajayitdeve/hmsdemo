<?php

namespace App\Http\Livewire\Nurse\DoctorMsg;

use App\Models\DoctorMessage;
use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DoctorMsg extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd_code, $ipd;
    public $umr, $patient_name,  $patient_type, $gender, $admn_no, $admn_date, $consultant, $corporate_name;
    public $message;
    public $message_list = [];

    public function rules(): array
    {
        return [
            'umr' => 'required',
            'message' => 'required',
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
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->gender = $ipd?->patient?->gender?->name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->getMessage();
        }
    }

    public function save()
    {
        $this->validate();

        DoctorMessage::create([
            'ipd_id' => $this->ipd?->id,
            'patient_id' => $this->ipd?->patient?->id,
            'message' => $this->message,
            'nurse_station_id' => session()->get("nurse_station_id"),
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Message added successfully.');

        $this->reset('message');

        $this->getMessage();
    }

    public function getMessage()
    {
        $this->message_list = DoctorMessage::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->where("nurse_station_id", session()->get("nurse_station_id"))
            ->get();
    }

    public function render()
    {
        return view('livewire.nurse.doctor-msg.doctor-msg')->extends('layouts.admin')->section('content');
    }
}

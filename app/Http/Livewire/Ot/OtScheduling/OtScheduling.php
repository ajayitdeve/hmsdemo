<?php

namespace App\Http\Livewire\Ot\OtScheduling;

use App\Models\Ot;
use App\Models\OtSchedule;
use App\Models\OtType;
use Carbon\Carbon;
use Livewire\Component;

class OtScheduling extends Component
{
    public $ot_type_id, $ot_type_code, $schedule_from, $schedule_to, $code, $status = "1";

    public $dates = [];
    public $timeSlots = [];
    public $scheduleData = [];

    public $ot_types = [];
    public $ot_list = [];

    public function mount()
    {
        $this->generate_code();
        $this->ot_types = OtType::where("is_active", "1")->get();
    }

    public function generate_code()
    {
        $this->code = 'OTS' . OtType::max('id') + 1;
        $this->schedule_from = date('Y-m-d');
        $this->schedule_to = date('Y-m-d');
    }

    public function otTypeChanged()
    {
        $ot_type = OtType::find($this->ot_type_id);
        if ($ot_type) {
            $this->ot_type_code = $ot_type->code;
        }
    }

    public function rules()
    {
        return [
            "ot_type_id" => "required",
            "ot_type_code" => "required",
            "schedule_from" => "required",
            "schedule_to" => "required",
            "code" => "required",
            "status" => "required",
            "scheduleData" => "required",
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function schedule()
    {
        $this->validate([
            "ot_type_id" => "required",
            "ot_type_code" => "required",
            "schedule_from" => "required",
            "schedule_to" => "required",
            "code" => "required",
            "status" => "required",
        ]);

        $startDate = Carbon::parse($this->schedule_from);
        $endDate = Carbon::parse($this->schedule_to);

        $timeSlots = [];
        for ($time = Carbon::createFromTime(0, 0); $time->lte(Carbon::createFromTime(23, 30)); $time->addMinutes(30)) {
            $timeSlots[] = $time->format('h:i A');
        }

        $dates = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dates->push($date->format('Y-m-d'));
        }
        $this->dates = $dates;
        $this->timeSlots = $timeSlots;

        $ots = Ot::where('ot_type_id', $this->ot_type_id)->where("is_active", "1")->get();
        $this->ot_list = $ots;

        $scheduleData = [];
        foreach ($dates as $date) {
            foreach ($timeSlots as $slot) {
                foreach ($ots as $ot) {
                    $existing = OtSchedule::where('schedule_date', $date)
                        ->where('schedule_time', Carbon::parse($slot)->format('H:i:s'))
                        ->where('ot_id', $ot->id)
                        ->first();

                    $scheduleData["{$date}_{$slot}_{$ot->id}"] = [
                        'date' => $date,
                        'time' => $slot,
                        'ot_id' => $ot->id,
                        'ot_name' => $ot->name,
                        'status' => $existing->status ?? 'available',
                    ];
                }
            }
        }

        $this->scheduleData = $scheduleData;
    }

    public function confirmation()
    {
        $this->validate();
        $this->dispatchBrowserEvent('open-confirmation-modal');
    }

    public function save()
    {
        $this->validate();

        foreach ($this->scheduleData as $data) {
            OTSchedule::updateOrCreate(
                [
                    'ot_id' => $data['ot_id'],
                    'schedule_date' => $data['date'],
                    'schedule_time' => Carbon::parse($data['time'])->format('H:i:s'),
                ],
                [
                    'status' => $data['status'],
                ]
            );
        }

        session()->flash('success', 'Schedule saved successfully!');
        $this->dispatchBrowserEvent('close-confirmation-modal');
    }

    public function render()
    {
        return view('livewire.ot.ot-scheduling.ot-scheduling')->extends('layouts.admin')->section('content');
    }
}

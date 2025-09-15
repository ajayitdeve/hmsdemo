<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\Ipd\Ipd;
use App\Models\Note;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class NurseNote extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd_code, $ipd;
    public $umr, $patient_name,  $patient_type, $status, $age, $gender, $admn_no, $admn_date, $consultant, $ward, $room, $bed, $corporate_name;
    public $note, $previous_note;
    public $notes = [];

    public function rules(): array
    {
        return [
            'umr' => 'required',
            'note' => 'required',
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

            $this->getNotes();
        }
    }

    public function getNotes()
    {
        $notes = Note::where('ipd_id', $this->ipd?->id)
            ->where('patient_id', $this->ipd?->patient?->id)
            ->latest()
            ->get();

        $this->notes = $notes;

        $this->previous_note = $notes->map(function ($note) {
            return "[" . $note->created_at->format('d-M-Y h:i a') . "] " . $note->note;
        })->implode("\n------------------\n");
    }

    public function save()
    {
        $this->validate();

        Note::create([
            'ipd_id' => $this->ipd?->id,
            'patient_id' => $this->ipd?->patient?->id,
            'note' => $this->note,
            'nurse_station_id' => session()->get("nurse_station_id"),
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Note added successfully.');

        $this->reset('note');

        $this->getNotes();
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.nurse-note')->extends('layouts.admin')->section('content');
    }
}

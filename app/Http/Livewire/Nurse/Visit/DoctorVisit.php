<?php

namespace App\Http\Livewire\Nurse\Visit;

use App\Models\Doctor;
use App\Models\Ipd\Ipd;
use App\Models\IpdDoctorVisit;
use App\Models\User;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class DoctorVisit extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $status, $admn_no, $patient_type, $consultant, $corporate_name, $admn_date, $ward, $room, $bed;
    public $doctor_visit_no, $service_date, $service_type, $doctor_id, $visit_date_time, $doctor_code, $department, $service_ward;
    public $visit_id, $reason, $approved_by, $show_cancel_button, $users = [];

    public $doctors = [];
    public $doctor_visit_list = [];

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

            $this->doctor_visit_no = $this->generateCode();
            $this->service_date = date("Y-m-d");
            $this->visit_date_time = date("Y-m-d H:i");

            $this->users = User::all();
            $this->doctors = Doctor::get();
            $this->getDoctorVisits();
        }
    }

    public function doctorChanged()
    {
        $doctor = Doctor::findOrFail($this->doctor_id);
        $this->service_type = "Consultations";
        $this->doctor_code = $doctor?->code;
        $this->department = $doctor?->department?->name;
        $this->service_ward = $this->ipd?->ward?->name;;
    }

    public function generateCode()
    {
        $count = IpdDoctorVisit::max("id");
        return "DOV" . ($count + 1);
    }

    public function save()
    {
        $this->validate([
            "doctor_id" => "required",
            "doctor_code" => "required",
            "department" => "required",
        ]);

        IpdDoctorVisit::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "code" => $this->generateCode(),
            "service_date" => date("Y-m-d", strtotime($this->service_date)),
            "service_type" => $this->service_type,
            "doctor_id" => $this->doctor_id,
            "visit_date_time" => date("Y-m-d H:i:s", strtotime($this->visit_date_time)),
            "is_cancelled" => "0",
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        $this->reset([
            "service_date",
            "service_type",
            "doctor_id",
            "visit_date_time",
            "doctor_code",
            "department",
            "service_ward",
        ]);

        $this->doctor_visit_no = $this->generateCode();
        $this->service_date = date("Y-m-d");
        $this->visit_date_time = date("Y-m-d H:i");
        $this->getDoctorVisits();

        session()->flash('success', 'Visit Created Successfully.');
    }

    public function getDoctorVisits()
    {
        $this->doctor_visit_list = IpdDoctorVisit::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->where("nurse_station_id", session()->get("nurse_station_id"))
            ->get();
    }

    public function view_cancel_visit($visit_id, $show_cancel_button = false)
    {
        $this->reset(['visit_id', 'reason', 'approved_by', 'show_cancel_button']);

        $this->visit_id = $visit_id;
        $visit = IpdDoctorVisit::find($this->visit_id);
        if ($visit) {
            $this->reason = $visit->cancelled_reason;
            $this->approved_by = $visit->cancelled_by_id;

            if ($show_cancel_button) {
                $this->show_cancel_button = true;
            }

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function cancel_visit()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $visit = IpdDoctorVisit::find($this->visit_id);
        if ($visit) {
            $visit->is_cancelled = 1;
            $visit->cancelled_reason = $this->reason;
            $visit->cancelled_by_id = $this->approved_by;
            $visit->save();

            $this->reset(['visit_id', 'reason', 'approved_by']);
            $this->getDoctorVisits();
            $this->dispatchBrowserEvent('hide-cancel-modal');
        }
    }

    public function render()
    {
        return view('livewire.nurse.visit.doctor-visit')->extends('layouts.admin')->section('content');;
    }
}

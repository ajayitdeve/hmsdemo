<?php

namespace App\Http\Livewire\Nurse\NursingProcess;

use App\Models\IntakeOutputEntry;
use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class InTakeOutPut extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $patient_type, $status, $age, $gender, $admn_no, $admn_date, $consultant, $ward, $room, $bed, $corporate_name;

    public $date_time, $iv_fluid, $iv_hrly, $iv_total, $oral_fluid, $oral_amount, $oral_total, $urine, $ngasp_rta, $drainage_d1, $drainage_d2, $drainage_d1_output, $drainage_d2_output, $misc, $sub_total, $total;

    public $intake_output_list = [];

    public function getIntakeOutput()
    {
        $this->intake_output_list = IntakeOutputEntry::where("ipd_id", $this->ipd?->id)
            ->where("patient_id", $this->ipd?->patient?->id)
            ->orderBy("date_time", "desc")
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

            $this->date_time = date("Y-m-d H:i");
            $this->getIntakeOutput();
            $this->resetInput();
        }
    }

    public function updated($field)
    {
        $this->iv_total = (float)$this->iv_hrly;

        $this->oral_total = (float)$this->oral_amount;

        $this->sub_total = (
            (float)$this->urine +
            (float)$this->ngasp_rta +
            (float)$this->drainage_d1 +
            (float)$this->drainage_d2 +
            (float)$this->drainage_d1_output +
            (float)$this->drainage_d2_output +
            (float)$this->misc
        );

        $this->total = $this->sub_total;
    }

    public function save()
    {
        $this->validate([
            'date_time' => 'required|date',
            'iv_fluid' => 'nullable|string',
            'iv_hrly' => 'required|numeric|min:0',
            'iv_total' => 'required|numeric|min:0',
            'oral_fluid' => 'nullable|string',
            'oral_amount' => 'required|numeric|min:0',
            'oral_total' => 'required|numeric|min:0',
            'urine' => 'required|numeric|min:0',
            'ngasp_rta' => 'required|numeric|min:0',
            'drainage_d1' => 'required|numeric|min:0',
            'drainage_d2' => 'required|numeric|min:0',
            'drainage_d1_output' => 'required|numeric|min:0',
            'drainage_d2_output' => 'required|numeric|min:0',
            'misc' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        IntakeOutputEntry::create([
            "ipd_id" => $this->ipd?->id,
            "patient_id" => $this->ipd?->patient?->id,
            "date_time" => date("Y-m-d H:i:s", strtotime($this->date_time)),
            'iv_fluid' => $this->iv_fluid,
            'iv_hrly' => $this->iv_hrly,
            'iv_total' => $this->iv_total,
            'oral_fluid' => $this->oral_fluid,
            'oral_amount' => $this->oral_amount,
            'oral_total' => $this->oral_total,
            'urine' => $this->urine,
            'ngasp_rta' => $this->ngasp_rta,
            'drainage_d1' => $this->drainage_d1,
            'drainage_d2' => $this->drainage_d2,
            'drainage_d1_output' => $this->drainage_d1_output,
            'drainage_d2_output' => $this->drainage_d2_output,
            'misc' => $this->misc,
            'sub_total' => $this->sub_total,
            'total' => $this->total,
            "nurse_station_id" => session()->get("nurse_station_id"),
            "created_by_id" => auth()->user()?->id,
        ]);

        $this->date_time = date("Y-m-d H:i");
        $this->getIntakeOutput();
        session()->flash('message', 'Intake Output Entry Created Successfully.');
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->iv_fluid = '';
        $this->iv_hrly = 0;
        $this->iv_total = 0;
        $this->oral_fluid = '';
        $this->oral_amount = 0;
        $this->oral_total = 0;
        $this->urine = 0;
        $this->ngasp_rta = 0;
        $this->drainage_d1 = 0;
        $this->drainage_d2 = 0;
        $this->drainage_d1_output = 0;
        $this->drainage_d2_output = 0;
        $this->misc = 0;
        $this->sub_total = 0;
        $this->total = 0;
    }

    public function render()
    {
        return view('livewire.nurse.nursing-process.in-take-out-put')->extends('layouts.admin')->section('content');
    }
}

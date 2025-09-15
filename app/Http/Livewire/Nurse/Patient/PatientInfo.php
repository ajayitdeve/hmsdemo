<?php

namespace App\Http\Livewire\Nurse\Patient;

use App\Models\Ipd\Ipd;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Livewire\Component;

class PatientInfo extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $admn_no, $patient_type, $consultant, $consultant_code, $corporate_name, $corporate_code, $admn_date, $admn_time, $ward, $room, $bed;
    public $father_name, $patient_address, $referral;

    public $responsible_proson, $mobile_number, $address, $date_of_birth, $religion, $city, $state, $country, $pincode, $telephone_number, $email_address, $fax_no;
    public $approval_amount = 0, $date_of_approval, $approval_time, $total_due_amount = 0, $emp_due_amount = 0;

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
            $this->father_name = $ipd?->patient?->father_name;
            $this->responsible_proson = $ipd?->patient?->father_name;
            $this->email_address = $ipd?->patient?->email;
            $this->mobile_number = $ipd?->patient?->mobile;
            $this->date_of_birth = date("Y-m-d", strtotime($ipd?->patient?->dob));
            $this->patient_address = $ipd?->patient?->address;
            $this->address = $ipd?->patient?->address;
            $this->pincode = $ipd?->patient?->pincode;
            $this->religion = $ipd?->patient?->religion?->name;
            $this->city = $ipd?->patient?->village?->district?->name;
            $this->state = $ipd?->patient?->village?->state?->name;
            $this->country = $ipd?->patient?->village?->country?->name;
            $this->referral = $ipd?->patient?->referral?->name;

            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d", strtotime($ipd->created_at));
            $this->admn_time = date("H:i", strtotime($ipd->created_at));
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->consultant = $ipd?->patient_visit?->doctor?->name;
            $this->consultant_code = $ipd?->patient_visit?->doctor?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;
        }
    }

    public function render()
    {
        return view('livewire.nurse.patient.patient-info')->extends('layouts.admin')->section('content');
    }
}

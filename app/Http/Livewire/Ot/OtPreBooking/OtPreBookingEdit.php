<?php

namespace App\Http\Livewire\Ot\OtPreBooking;

use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OtPreBooking;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Models\Title;
use Carbon\Carbon;
use Livewire\Component;

class OtPreBookingEdit extends Component
{
    public $ot_pre_booking_id, $type, $pre_booking_no, $pre_booking_date, $booking_type = "selective", $status = "Not Approved";
    public $out_side_patient_id, $title_id, $gender_id, $mobile, $address;
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $for_day_care, $doctor_id, $doctor_code, $service_id, $service_code, $surgery_date, $surgery_type_id, $surgery_type_code, $diagnosis, $remarks;

    public $titles = [];
    public $genders = [];
    public $patients = [];
    public $ipds = [];
    public $doctors = [];
    public $services = [];
    public $surgery_types = [];

    public function mount($id)
    {
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();

        $ot_pre_booking = OtPreBooking::find($id);
        if ($ot_pre_booking) {
            $this->ot_pre_booking_id = $ot_pre_booking->id;
            $this->pre_booking_no = $ot_pre_booking->code;
            $this->pre_booking_date = date("Y-m-d H:i", strtotime($ot_pre_booking->created_at));

            $this->type = $ot_pre_booking->type;
            $this->ipd_id = $ot_pre_booking->ipd_id;
            $this->patient_id = $ot_pre_booking->patient_id;
            $this->out_side_patient_id = $ot_pre_booking->out_side_patient_id;

            if ($this->type == "in-patient") {
                $this->ipdChanged();
            }

            if ($this->type == "out-patient") {
                $patient = Patient::where("id", $this->patient_id)->first();
                if ($patient) {
                    $this->umr = $patient->registration_no;
                    $this->patient_name = $patient?->name;
                    $this->title_id = $patient->title_id;
                    $this->gender_id = $patient->gender_id;
                    $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
                    $this->gender = $patient?->gender?->name;
                    $this->patient_type = $patient?->patienttype?->name;

                    $ipd = $patient->ipds()->latest()->first();
                    $this->ipd_id = $ipd->id;
                    $this->admn_no = $ipd->ipdcode;
                    $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
                    $this->ward = $ipd->ward?->name;
                    $this->room = $ipd->room?->name;
                    $this->bed = $ipd->bed?->display_name;

                    $this->consultant_name = $ipd->patient_visit?->doctor?->name;
                    $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
                    $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
                }
            }

            if ($this->type == "outside-patient") {
                $out_side_patient = OutSidePatient::where("id", $this->out_side_patient_id)->first();
                if ($out_side_patient) {
                    $this->title_id = $out_side_patient->title_id;
                    $this->patient_name = $out_side_patient->name;
                    $this->mobile = $out_side_patient->mobile;
                    $this->age = $out_side_patient->age;
                    $this->address = $out_side_patient->address;
                    $this->gender_id = $out_side_patient->gender_id;
                }
            }


            $this->booking_type = $ot_pre_booking->booking_type;
            $this->doctor_id = $ot_pre_booking->doctor_id;
            $this->doctorChanged();
            $this->service_id = $ot_pre_booking->service_id;
            $this->serviceChanged();
            $this->surgery_date = date("Y-m-d H:i", strtotime($ot_pre_booking->surgery_date));
            $this->surgery_type_id = $ot_pre_booking->surgery_type_id;
            $this->surgeryTypeChanged();
            $this->for_day_care = $ot_pre_booking->for_day_care ? true : false;
            $this->diagnosis = $ot_pre_booking->diagnosis;
            $this->remarks = $ot_pre_booking->remarks;
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_name = $ipd?->patient?->name;
            $this->title_id = $ipd?->patient?->title_id;
            $this->gender_id = $ipd?->patient?->gender_id;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $ipd?->patient?->gender?->name;
            $this->patient_type = $ipd?->patient?->patienttype?->name;

            $this->admn_no = $ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->consultant_name = $ipd?->patient_visit?->doctor?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $this->patient_id = $patient->id;
            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd->id;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;

            $this->consultant_name = $ipd->patient_visit?->doctor?->name;
            $this->corporate_code = $ipd?->corporate_registration?->organization?->code;
            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
        }
    }

    public function doctorChanged()
    {
        $doctor = Doctor::find($this->doctor_id);
        if ($doctor) {
            $this->doctor_code = $doctor->code;
        }
    }

    public function serviceChanged()
    {
        $service = Service::find($this->service_id);
        if ($service) {
            $this->service_code = $service->code;
        }
    }

    public function surgeryTypeChanged()
    {
        $surgeryType = SurgeryType::find($this->surgery_type_id);
        if ($surgeryType) {
            $this->surgery_type_code = $surgeryType->code;
        }
    }

    public function rules()
    {
        $rules = [
            'booking_type' => 'required',
            'doctor_id' => 'required',
            'doctor_code' => 'required',
            'service_id' => 'required',
            'service_code' => 'required',
        ];

        return $rules;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        if ($this->type == 'outside-patient') {
            OutSidePatient::where('id', $this->out_side_patient_id)->update([
                'name' => $this->patient_name,
                'mobile' => $this->mobile,
                'age' => $this->age,
                'address' => $this->address,
                'title_id' => $this->title_id,
                'gender_id' => $this->gender_id,
                'updated_by_id' => auth()->user()?->id,
            ]);
        }

        OtPreBooking::where("id", $this->ot_pre_booking_id)->update([
            'doctor_id' => $this->doctor_id,
            'service_id' => $this->service_id,
            'surgery_type_id' => $this->surgery_type_id,
            'for_day_care' => $this->for_day_care ? '1' : '0',
            'booking_type' => $this->booking_type,
            'surgery_date' => $this->surgery_date,
            'diagnosis' => $this->diagnosis,
            'remarks' => $this->remarks,
        ]);

        session()->flash('message', 'OT Pre Booking Updated Successfully.');
        return redirect()->route('admin.ot.ot-pre-booking');
    }

    public function render()
    {
        return view('livewire.ot.ot-pre-booking.ot-pre-booking-edit')->extends('layouts.admin')->section('content');
    }
}

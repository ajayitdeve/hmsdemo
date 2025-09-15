<?php

namespace App\Http\Livewire\Ot\OtBooking;

use App\Models\AnesthesiaType;
use App\Models\Doctor;
use App\Models\Ot;
use App\Models\OtBooking;
use App\Models\OtBookingAttendant;
use App\Models\OtSchedule;
use App\Models\OtType;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Traits\OtAttendantUpdate;
use Carbon\Carbon;
use Livewire\Component;

class OtBookingEdit extends Component
{
    use OtAttendantUpdate;

    public $ot_booking_id, $ot_booking_no, $booking_date, $booking_type = "selective", $status = "Not Approved";
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $doctor_id, $doctor_code, $service_id, $service_code, $surgery_type_id, $surgery_type_code, $duration, $surgery_date, $ot_type_id, $ot_type_code, $from_time, $to_time;
    public $ot_id, $ot_code, $anesthesia_type_id, $for_day_care, $icd_code, $cpt_code, $remarks, $diagnosis;

    public $arrCart = [];
    public $activeTab = 'surgery-details';

    public $patients = [];
    public $doctors = [];
    public $services = [];
    public $surgery_types = [];
    public $ot_types = [];
    public $ot_list = [];
    public $anesthesia_types = [];

    public $attendant_types = [];

    public function mount($id)
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
        $this->ot_types = OtType::where("is_active", "1")->get();
        $this->ot_list = Ot::where("is_active", "1")->get();
        $this->anesthesia_types = AnesthesiaType::where("is_active", "1")->get();

        $ot_booking = OtBooking::with('attendants')->find($id);

        if ($ot_booking) {
            $this->ot_booking_id = $ot_booking->id;
            $this->ot_booking_no = $ot_booking->code;
            $this->booking_date = date("Y-m-d H:i", strtotime($ot_booking->created_at));
            $this->booking_type = $ot_booking->booking_type;
            $this->status = "Approved";

            $this->umr = $ot_booking?->patient?->registration_no;
            $this->ipd_id = $ot_booking->ipd_id;
            $this->umrChanged();

            $this->doctor_id = $ot_booking->doctor_id;
            $this->doctorChanged();

            $this->service_id = $ot_booking->service_id;
            $this->serviceChanged();

            $this->surgery_type_id = $ot_booking->surgery_type_id;
            $this->surgeryTypeChanged();

            $this->ot_type_id = $ot_booking->ot_type_id;
            $this->otTypeChanged();

            $this->ot_id = $ot_booking->ot_id;
            $this->otChanged();

            $this->duration = $ot_booking->duration;
            $this->surgery_date = date("Y-m-d", strtotime($ot_booking->surgery_date));
            $this->from_time = date("H:i", strtotime($ot_booking->from_time));
            $this->to_time = date("H:i", strtotime($ot_booking->to_time));
            $this->anesthesia_type_id = $ot_booking->anesthesia_type_id;
            $this->for_day_care = $ot_booking->for_day_care ? 1 : 0;
            $this->icd_code = $ot_booking->icd_code;
            $this->cpt_code = $ot_booking->cpt_code;
            $this->remarks = $ot_booking->remarks;
            $this->diagnosis = $ot_booking->diagnosis;

            $this->ot_booking_attendant_init($ot_booking);
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

            $ipd = $patient->ipds()->where("id", $this->ipd_id)->latest()->first();
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

    public function otTypeChanged()
    {
        $otType = OtType::find($this->ot_type_id);
        if ($otType) {
            $this->ot_type_code = $otType->code;
        }
    }

    public function otChanged()
    {
        $ot = Ot::find($this->ot_id);
        if ($ot) {
            $this->ot_code = $ot->code;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function rules()
    {
        return [
            'umr' => 'required',
            'patient_id' => 'required',
            'admn_no' => 'required',
            'ipd_id' => 'required',
            'doctor_id' => 'required',
            'doctor_code' => 'required',
            'service_id' => 'required',
            'service_code' => 'required',
            'ot_type_id' => 'required',
            'ot_type_code' => 'required',
            'ot_id' => 'required',
            'ot_code' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $ot_schedule = OtSchedule::where('ot_id', $this->ot_id)
            ->whereIn('status', ['booked', 'not-available'])
            ->where('schedule_date', $this->surgery_date)
            ->whereBetween('schedule_time', [$this->from_time, $this->to_time])
            ->first();

        if ($ot_schedule) {
            session()->flash('error', 'OT Schedule is already this date and time.');
            return;
        }

        $ot_booking = OtBooking::find($this->ot_booking_id);
        if ($ot_booking) {
            $ot_booking->update([
                "booking_type" => $this->booking_type,
                "doctor_id" => $this->doctor_id,
                "service_id" => $this->service_id,
                "surgery_type_id" => $this->surgery_type_id,
                "duration" => $this->duration,
                "surgery_date" => date("Y-m-d", strtotime($this->surgery_date)),
                "ot_type_id" => $this->ot_type_id,
                "from_time" => $this->from_time,
                "to_time" => $this->to_time,
                "ot_id" => $this->ot_id,
                "anesthesia_type_id" => $this->anesthesia_type_id,
                "for_day_care" => $this->for_day_care,
                "icd_code" => $this->icd_code,
                "cpt_code" => $this->cpt_code,
                "remarks" => $this->remarks,
                "diagnosis" => $this->diagnosis,
            ]);

            OtBookingAttendant::where('ot_booking_id', $this->ot_booking_id)->delete();

            foreach ($this->arrCart as $attendant) {
                if (!empty($attendant['attendant_name']) && !empty($attendant['attendant_type']) && !empty($attendant['attendant_id'])) {
                    OtBookingAttendant::create([
                        'name' => $attendant['attendant_name'],
                        'attendant_type' => $attendant['attendant_type'],
                        'attendant_id' => $attendant['attendant_id'],
                        'ot_booking_id' => $this->ot_booking_id,
                    ]);
                }
            }

            session()->flash('success', 'OT Booking has been saved successfully.');
            return;
        }

        session()->flash('error', 'Something went wrong.');
    }

    public function render()
    {
        return view('livewire.ot.ot-booking.ot-booking-edit')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Ot\OtBooking;

use App\Models\AnesthesiaType;
use App\Models\Doctor;
use App\Models\Ot;
use App\Models\OtBooking as OtBookingModel;
use App\Models\OtBookingAttendant;
use App\Models\OtPreBooking;
use App\Models\OtSchedule;
use App\Models\OtType;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Models\User;
use App\Traits\OtAttendantCreate;
use Carbon\Carbon;
use Livewire\Component;

class OtBooking extends Component
{
    use OtAttendantCreate;

    public $ot_booking_no, $booking_date, $booking_type = "selective", $status = "Not Approved";
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

    public function mount()
    {
        $this->generate_code();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
        $this->ot_types = OtType::where("is_active", "1")->get();
        $this->ot_list = Ot::where("is_active", "1")->get();
        $this->anesthesia_types = AnesthesiaType::where("is_active", "1")->get();
    }

    public function generate_code()
    {
        $this->ot_booking_no = 'OTB' . OtBookingModel::max('id') + 1;
        $this->booking_date = date("Y-m-d H:i");
        $this->surgery_date = date("Y-m-d");
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

            $ot_pre_booking = OtPreBooking::where("ipd_id", $this->ipd_id)->where("patient_id", $this->patient_id)->latest()->first();
            if ($ot_pre_booking) {
                $this->doctor_id = $ot_pre_booking->doctor_id;
                $this->doctorChanged();
                $this->service_id = $ot_pre_booking->service_id;
                $this->serviceChanged();
                $this->surgery_type_id = $ot_pre_booking->surgery_type_id;
                $this->surgeryTypeChanged();
                $this->for_day_care = $ot_pre_booking->for_day_care ? 1 : 0;
                $this->booking_type = $ot_pre_booking->booking_type;
                $this->surgery_date = date("Y-m-d", strtotime($ot_pre_booking->surgery_date));
            } else {
                $this->doctor_id = null;
                $this->doctor_code = null;
                $this->service_id = null;
                $this->service_code = null;
                $this->surgery_type_id = null;
                $this->surgery_type_code = null;
                $this->for_day_care = null;
                $this->booking_type = null;
                $this->surgery_date = null;
            }
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

    public function calculateDuration()
    {
        $from = Carbon::parse($this->from_time);
        $to = Carbon::parse($this->to_time);

        $durationInMinutes = $to->diffInMinutes($from);
        $this->duration = (string) $durationInMinutes;
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

        $ot_booking = OtBookingModel::create([
            'ipd_id' => $this->ipd_id,
            'patient_id' => $this->patient_id,
            'code' => $this->ot_booking_no,
            'doctor_id' => $this->doctor_id,
            'service_id' => $this->service_id,
            'surgery_type_id' => $this->surgery_type_id,
            'booking_type' => $this->booking_type,
            'duration' => $this->duration,
            'surgery_date' => $this->surgery_date,
            'ot_type_id' => $this->ot_type_id,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'ot_id' => $this->ot_id,
            'anesthesia_type_id' => $this->anesthesia_type_id,
            'for_day_care' => $this->for_day_care ? '1' : '0',
            'icd_code' => $this->icd_code,
            'cpt_code' => $this->cpt_code,
            'remarks' => $this->remarks,
            'diagnosis' => $this->diagnosis,
            'created_by_id' => auth()->user()?->id,
        ]);

        if ($ot_booking) {

            foreach ($this->arrCart as $attendant) {
                if (!empty($attendant['attendant_name']) && !empty($attendant['attendant_type']) && !empty($attendant['attendant_id'])) {
                    OtBookingAttendant::create([
                        'name' => $attendant['attendant_name'],
                        'attendant_type' => $attendant['attendant_type'],
                        'attendant_id' => $attendant['attendant_id'],
                        'ot_booking_id' => $ot_booking->id,
                    ]);
                }
            }

            session()->flash('success', 'OT Booking has been saved successfully.');
            return redirect()->route('admin.ot.ot-booking');
        }
    }

    public function render()
    {
        return view('livewire.ot.ot-booking.ot-booking')->extends('layouts.admin')->section('content');
    }
}

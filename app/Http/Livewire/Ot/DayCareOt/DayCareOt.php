<?php

namespace App\Http\Livewire\Ot\DayCareOt;

use App\Models\AnesthesiaType;
use App\Models\Doctor;
use App\Models\Ot;
use App\Models\OtBooking;
use App\Models\OtDayCare;
use App\Models\OtDayCareConsultant;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Traits\OtAttendantUpdate;
use Carbon\Carbon;
use Livewire\Component;

class DayCareOt extends Component
{
    use OtAttendantUpdate;

    public $day_care_no, $day_care_date, $type = "scheduled-patients", $status;
    public $patient_id, $umr, $patient_name, $age, $gender, $patient_type, $ipd_id, $admn_no, $admn_date, $ward, $room, $bed, $consultant_name, $corporate_code, $corporate_name;
    public $ot_booking_id, $ot_booking_no, $ot_booking_date, $service_id, $service_code, $surgery_type_id, $surgery_type_code, $ot_id, $ot_code, $surgery_date, $duration, $from_time, $to_time;
    public $doctor_id, $doctor_code, $anesthesia_type_id, $diagnosis, $remarks;

    public $activeTab = 'procedure-details';

    public $patients = [];
    public $doctors = [];
    public $services = [];
    public $surgery_types = [];
    public $ot_list = [];
    public $anesthesia_types = [];

    public $arrCart = [];
    public $attendant_types = [];

    public function mount()
    {
        $this->generate_code();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
        $this->ot_list = Ot::where("is_active", "1")->get();
        $this->anesthesia_types = AnesthesiaType::where("is_active", "1")->get();

        $this->status = 'Not Approved';
    }

    public function generate_code()
    {
        $this->day_care_no = 'DCN' . OtDayCare::max('id') + 1;
        $this->day_care_date = date("Y-m-d H:i");
        $this->ot_booking_date = date("Y-m-d H:i");
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

            $ot_booking = OtBooking::with('attendants')
                ->where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->where("is_cancelled", 0)
                ->latest()
                ->first();

            if ($ot_booking) {
                $this->ot_booking_id = $ot_booking->id;
                $this->ot_booking_no = $ot_booking->code;
                $this->ot_booking_date = date("Y-m-d H:i", strtotime($ot_booking->created_at));
                $this->service_id = $ot_booking->service_id;
                $this->service_code = $ot_booking?->service?->code;
                $this->surgery_type_id = $ot_booking->surgery_type_id;
                $this->surgery_type_code = $ot_booking?->surgery_type?->code;
                $this->ot_id = $ot_booking->ot_id;
                $this->ot_code = $ot_booking?->ot?->code;
                $this->surgery_date = date("Y-m-d", strtotime($ot_booking->surgery_date));
                $this->duration = $ot_booking->duration;
                $this->from_time = date("H:i", strtotime($ot_booking->from_time));
                $this->to_time = date("H:i", strtotime($ot_booking->to_time));
                $this->doctor_id = $ot_booking->doctor_id;
                $this->doctor_code = $ot_booking?->doctor?->code;
                $this->anesthesia_type_id = $ot_booking->anesthesia_type_id;


                $this->ot_booking_attendant_init($ot_booking);
            } else {
                $this->ot_booking_id = null;
                $this->ot_booking_no = null;
                $this->ot_booking_date = date("Y-m-d H:i");
                $this->service_id = null;
                $this->service_code = null;
                $this->surgery_type_id = null;
                $this->surgery_type_code = null;
                $this->ot_id = null;
                $this->ot_code = null;
                $this->surgery_date = date("Y-m-d");
                $this->duration = null;
                $this->from_time = null;
                $this->to_time = null;
                $this->doctor_id = null;
                $this->doctor_code = null;
                $this->anesthesia_type_id = null;

                $this->arrCart = [];
                $this->addRow();
            }
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

    public function otChanged()
    {
        $ot = Ot::find($this->ot_id);
        if ($ot) {
            $this->ot_code = $ot->code;
        }
    }

    public function doctorChanged()
    {
        $doctor = Doctor::find($this->doctor_id);
        if ($doctor) {
            $this->doctor_code = $doctor->code;
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function rules()
    {
        return [
            'day_care_no' => 'required',
            'day_care_date' => 'required',
            'umr' => 'required',
            'patient_id' => 'required',
            'admn_no' => 'required',
            'ipd_id' => 'required|unique:ot_day_cares,ipd_id',
            'ot_booking_no' => 'required',
            'ot_booking_date' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function confirmation()
    {
        $this->validate();
        $this->dispatchBrowserEvent('open-confirmation-modal');
    }

    public function save()
    {
        $this->validate();

        $ot_day_care = OtDayCare::create([
            'ot_booking_id' => $this->ot_booking_id,
            'ipd_id' => $this->ipd_id,
            'patient_id' => $this->patient_id,
            'code' => $this->day_care_no,
            'type' => $this->type,
            'service_id' => $this->service_id,
            'surgery_type_id' => $this->surgery_type_id,
            'ot_id' => $this->ot_id,
            'surgery_date' => $this->surgery_date,
            'duration' => $this->duration,
            'from_time' => $this->from_time,
            'to_time' => $this->to_time,
            'doctor_id' => $this->doctor_id,
            'anesthesia_type_id' => $this->anesthesia_type_id,
            'diagnosis' => $this->diagnosis,
            'remarks' => $this->remarks,
            'created_by_id' => auth()->user()?->id,
        ]);

        if ($ot_day_care) {
            foreach ($this->arrCart as $attendant) {
                if (!empty($attendant['attendant_name']) && !empty($attendant['attendant_type']) && !empty($attendant['attendant_id'])) {
                    OtDayCareConsultant::create([
                        'name' => $attendant['attendant_name'],
                        'attendant_type' => $attendant['attendant_type'],
                        'attendant_id' => $attendant['attendant_id'],
                        'ot_day_care_id' => $ot_day_care->id,
                    ]);
                }
            }

            session()->flash('success', 'Day Care has been saved successfully.');
            return redirect()->route('admin.ot.day-care');
        }
    }

    public function render()
    {
        return view('livewire.ot.day-care-ot.day-care-ot')->extends('layouts.admin')->section('content');
    }
}

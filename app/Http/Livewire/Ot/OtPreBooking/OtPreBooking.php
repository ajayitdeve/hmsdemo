<?php

namespace App\Http\Livewire\Ot\OtPreBooking;

use App\Models\Doctor;
use App\Models\Gender;
use App\Models\Ipd\Ipd;
use App\Models\OtPreBooking as OtPreBookingModel;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\SurgeryType;
use App\Models\Title;
use Carbon\Carbon;
use Livewire\Component;

class OtPreBooking extends Component
{
    public $type = "in-patient", $pre_booking_no, $pre_booking_date, $booking_type = "selective", $status = "Not Approved";
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

    public function mount()
    {
        $this->generate_code();
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->doctors = Doctor::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::where("is_active", "1")->get();
    }

    public function generate_code()
    {
        $this->pre_booking_no = 'OTPB' . OtPreBookingModel::max('id') + 1;
        $this->pre_booking_date = date("Y-m-d H:i");
        $this->surgery_date = date("Y-m-d H:i");
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
            'ipd_id' => 'required_if:type,in-patient',
            'umr' => 'required_if:type,out-patient',
            'booking_type' => 'required',
            'doctor_id' => 'required',
            'doctor_code' => 'required',
            'service_id' => 'required',
            'service_code' => 'required',
        ];

        if (in_array($this->type, ['in-patient', 'out-patient'])) {
            $rules['patient_id'] = 'required';
        }

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
            $ospMaxId = OutSidePatient::max('id');
            $ospCode = 'OSD' . date('y') . date('m') . date('d') . $ospMaxId + 1;

            $out_side_patient = OutSidePatient::create([
                'registration_no' => $ospCode,
                'name' => $this->patient_name,
                'mobile' => $this->mobile,
                'age' => $this->age,
                'address' => $this->address,
                'title_id' => $this->title_id,
                'gender_id' => $this->gender_id,
                'created_by_id' => auth()->user()?->id,
            ]);

            $this->out_side_patient_id = $out_side_patient->id;
        }

        OtPreBookingModel::create([
            'ipd_id' => $this->ipd_id,
            'patient_id' => $this->patient_id,
            'code' => $this->pre_booking_no,
            'doctor_id' => $this->doctor_id,
            'service_id' => $this->service_id,
            'surgery_type_id' => $this->surgery_type_id,
            'for_day_care' => $this->for_day_care ? '1' : '0',
            'type' => $this->type,
            'out_side_patient_id' => $this->out_side_patient_id,
            'booking_type' => $this->booking_type,
            'surgery_date' => $this->surgery_date,
            'diagnosis' => $this->diagnosis,
            'remarks' => $this->remarks,
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('message', 'OT Pre Booking Added Successfully.');
        return redirect()->route('admin.ot.ot-pre-booking');
    }

    public function render()
    {
        return view('livewire.ot.ot-pre-booking.ot-pre-booking')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Doctor;

use App\Models\ConsultationType;
use App\Models\ConsultingType;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\DoctorType;
use App\Models\Gender;
use App\Models\PaymentType;
use App\Models\Specialization;
use App\Models\Title;
use App\Models\Unit;

use Livewire\Component;
use App\Traits\CreateUser;

class DoctorRegistration extends Component
{
    use CreateUser;

    public $code, $gender_id, $name, $alias, $registration_no, $designation, $consulting_room, $email, $mobile, $dob, $marriage_date, $fee, $email_verified_at, $password, $remember_token, $qualification, $about_doctor, $experience, $resigned_date, $specialization1, $specialization2, $cost_center_id, $payment_type_id, $consultation_type_id, $doctor_type_id, $consulting_type_id, $department_id, $unit_id, $specialization_id, $created_by_id;
    public $user, $units = [], $departments = [], $specializations = [], $consultationtypes = [], $doctortypes = [], $consultingtypes = [], $paymenttypes = [], $costcenters = [], $genders = [];
    public $doctor_id, $address, $doj;
    public $title_id;
    public $titles = [];

    public function mount()
    {
        $this->titles = Title::get();
        $this->specializations = Specialization::get();
        $this->departments = Department::where('is_medical', 1)->get();
        $this->consultationtypes = ConsultationType::get();
        $this->doctortypes = DoctorType::get();
        $this->consultingtypes = ConsultingType::get();
        //  $this->units=Unit::all();
        $this->paymenttypes = PaymentType::get();
        $this->costcenters = CostCenter::get();
        $this->genders = Gender::get();

        $this->user = Auth()->user();
        $this->cost_center_id = CostCenter::first()?->id;
        $this->title_id = Title::first()?->id;
        $this->titleChanged();
    }

    function rules()
    {
        return [
            'code' => 'required',
            'title_id' => 'required',
            'name' => 'required',
            'registration_no' => 'required',
            'designation' => 'required',
            // 'email' => 'required|unique:doctors',
            'password' => 'required',
            // 'mobile' => 'required',
            // 'dob' => 'required',
            // 'specialization1' => 'required',
            'cost_center_id' => 'required',
            'payment_type_id' => 'required',
            'consultation_type_id' => 'required',
            'doctor_type_id' => 'required',
            'consulting_type_id' => 'required',
            'department_id' => 'required',
            'unit_id' => 'required',
            'gender_id' => 'required',
            'specialization_id' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function titleChanged()
    {
        $title = Title::find($this->title_id);
        $this->gender_id = $title?->gender_id;
    }

    public function genderChanged()
    {
        // $title = Title::where("gender_id", $this->gender_id)->first();
        // if ($title) {
        //     $this->title_id = $title->id;
        // } else {
        //     $this->title_id = Title::first()?->id;
        // }
    }

    public function save()
    {
        $this->validate();

        $doctor = [
            'code' => $this->getDoctorCode($this->department_id),
            'title_id' => $this->title_id,
            'name' => $this->name,
            'alias' => $this->alias,
            'registration_no' => $this->registration_no,
            'designation' => $this->designation,
            'consulting_room' => $this->consulting_room,
            'email' => $this->email ?: null,
            'mobile' => $this->mobile ?: null,
            'dob' => $this->dob ? date("Y-m-d", strtotime($this->dob)) : null,
            'marriage_date' => $this->marriage_date,
            'fee' => $this->fee,
            'email_verified_at' => null,
            'password' => bcrypt($this->password),
            'qualification' => $this->qualification,
            'about_doctor' => $this->about_doctor,
            'experience' => $this->experience,
            'doj' => $this->doj ? date("Y-m-d", strtotime($this->doj)) : null,
            'resigned_date' => $this->resigned_date,
            'specialization1' => $this->specialization1 ?: null,
            'specialization2' => $this->specialization2 ?: null,
            'cost_center_id' => $this->cost_center_id,
            'payment_type_id' => $this->payment_type_id,
            'consultation_type_id' => $this->consultation_type_id,
            'doctor_type_id' => $this->doctor_type_id,
            'consulting_type_id' => $this->consulting_type_id,
            'department_id' => $this->department_id,
            'unit_id' => $this->unit_id,
            'gender_id' => $this->gender_id,
            'specialization_id' => $this->specialization_id,
            'address' => $this->address,
            'created_by_id' => auth()->user()?->id
        ];

        $result = Doctor::create($doctor);
        if ($result) {
            session()->flash('message', 'Doctor Added Successfully.');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('message', 'Something went wront ! Try Again');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function getDoctorCode($department_id)
    {
        $doctorDepartment = Department::where('id', $department_id)->first();
        $doctorMaxId = Doctor::max('id');
        if ($doctorMaxId < 10) {
            return $doctorDepartment->code . '-0' . $doctorMaxId;
        } else {
            return $doctorDepartment->code . '-' . $doctorMaxId;
        }
    }

    public function closeModal()
    {
        $this->reset();
        $this->specializations = Specialization::get();
        $this->departments = Department::where('is_medical', 1)->get();
        $this->consultationtypes = ConsultationType::get();
        $this->doctortypes = DoctorType::get();
        $this->consultingtypes = ConsultingType::get();
        //  $this->units=Unit::all();
        $this->paymenttypes = PaymentType::get();
        $this->costcenters = CostCenter::get();
        $this->genders = Gender::get();

        $this->user = Auth()->user();
    }

    public function resetInput()
    {
        $this->reset();
        $this->mount();
    }

    public function departmentChanged()
    {
        if ($this->department_id != null) {
            $this->units = Unit::where('department_id', $this->department_id)->get();
            $this->code = $this->getDoctorCode($this->department_id);
        }
    }

    public function edit(int $doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        if ($doctor) {
            $this->doctor_id = $doctor_id;
            $this->code = $doctor->code;
            $this->title_id = $doctor?->title_id;
            $this->name = $doctor->name;
            $this->alias = $doctor->alias;
            $this->registration_no = $doctor->registration_no;
            $this->designation = $doctor->designation;
            $this->consulting_room = $doctor->consulting_room;
            $this->email = $doctor->email;

            $this->mobile = $doctor->mobile;
            $this->dob = $doctor->dob;
            $this->marriage_date = $doctor->marriage_date;
            $this->fee = $doctor->fee;
            $this->qualification = $doctor->qualification;
            $this->about_doctor = $doctor->about_doctor;
            $this->experience = $doctor->experience;
            $this->doj = $doctor->doj;
            $this->resigned_date = $doctor->resigned_date;
            $this->specialization1 = $doctor->specialization1;
            $this->specialization2 = $doctor->specialization2;
            $this->cost_center_id = $doctor->cost_center_id;
            $this->payment_type_id = $doctor->payment_type_id;
            $this->consultation_type_id = $doctor->consultation_type_id;
            $this->doctor_type_id = $doctor->doctor_type_id;
            $this->consulting_type_id = $doctor->consulting_type_id;
            $this->department_id = $doctor->department_id;
            $this->unit_id = $doctor->unit_id;
            $this->gender_id = $doctor->gender_id;
            $this->specialization_id = $doctor->specialization_id;
            $this->address = $doctor->address;
        } else {
        }
    }

    public function update()
    {
        // $validatedData = $this->validate();
        $data = [
            'title_id' => $this->title_id,
            'name' => $this->name,
            'alias' => $this->alias,
            'registration_no' => $this->registration_no,
            'designation' => $this->designation,
            'consulting_room' => $this->consulting_room,
            'email' => $this->email ?: null,
            'mobile' => $this->mobile ?: null,
            'dob' => $this->dob ? date("Y-m-d", strtotime($this->dob)) : null,
            'marriage_date' => $this->marriage_date,
            'fee' => $this->fee,
            'qualification' => $this->qualification,
            'about_doctor' => $this->about_doctor,
            'experience' => $this->experience,
            'doj' => $this->doj ? date("Y-m-d", strtotime($this->doj)) : null,
            'resigned_date' => $this->resigned_date,
            'specialization1' => $this->specialization1 ?: null,
            'specialization2' => $this->specialization2 ?: null,
            'cost_center_id' => $this->cost_center_id,
            'payment_type_id' => $this->payment_type_id,
            'consultation_type_id' => $this->consultation_type_id,
            'doctor_type_id' => $this->doctor_type_id,
            'consulting_type_id' => $this->consulting_type_id,
            'department_id' => $this->department_id,
            'unit_id' => $this->unit_id,
            'gender_id' => $this->gender_id,
            'specialization_id' => $this->specialization_id,
            'address' => $this->address,
            'updated_by_id' => auth()->user()?->id
        ];
        Doctor::where('id', $this->doctor_id)->update($data);
        session()->flash('message', 'Doctor Updated  Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $doctor_id)
    {
        $this->doctor_id = $doctor_id;
    }

    public function destroy()
    {
        Doctor::find($this->doctor_id)->delete();
        session()->flash('message', 'Doctor delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $doctors = Doctor::orderBy('id', 'DESC')->get();

        return view('livewire.doctor.doctor-registration', ['doctors' => $doctors])->extends('layouts.admin')->section('content');
    }
}

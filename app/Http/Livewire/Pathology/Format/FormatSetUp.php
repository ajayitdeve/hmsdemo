<?php

namespace App\Http\Livewire\Pathology\Format;

use App\Models\Doctor;
use Livewire\Component;
use App\Models\Department;
use App\Models\Service\Service;

use App\Models\Pathology\TimeIn;
use App\Models\Pathology\Format;
use App\Models\Pathology\Parameter;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;
use App\Models\Pathology\FormatParameter;


class FormatSetUp extends Component
{

    public $formats = [], $departments, $servicegroups, $services, $doctors, $timins, $parameters, $parameterValuesArr = [], $parameterValuesCounter = 0, $sub_title, $parameter_id;
    public $department_id, $service_group_id, $service_id, $gender_id, $doctor_id, $lab_equivalent_name, $report_title, $code, $name, $method, $is_gender_specific, $is_sample_needed = false, $is_default_format = false, $is_growth, $specimen = false, $column_cap_1, $column_cap_2, $column_cap_3, $column_cap_4, $is_accrediation_needed = false, $is_multiple_oranism_needed = false, $is_clinical_history = false, $is_no_normal_range = false, $min_time, $time_ins_min, $max_time, $time_ins_max;

    public function mount()
    {
        $this->services = Service::get();
        $this->departments = Department::get();
        $this->servicegroups = ServiceGroup::get();
        $this->doctors = Doctor::get();
        $this->timins = TimeIn::get();
        $this->parameters = Parameter::get();
        $this->formats = Format::latest()->get();
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }

    public function serviceGroupChanged()
    {
        $this->services = Service::where('service_group_id', $this->service_group_id)->get();
    }

    public function addToCart()
    {
        $this->validate([
            "sub_title" => "required",
            "parameter_id" => "required",
        ]);

        $this->parameterValuesCounter++;
        $parameterCart = new \App\Services\FormatParameterCart($this->parameterValuesCounter, $this->parameter_id, $this->sub_title);

        $parameter = Parameter::find($this->parameter_id);
        if ($parameter) {
            $temp = [];
            $temp['id'] = $parameterCart->id;
            $temp['sub_title'] = $parameterCart->sub_title;
            $temp['parameter_id'] = $parameterCart->parameter_id;
            $temp['parameter_name'] = $parameter->name;
            $temp['parameter_code'] = $parameter->code;

            array_push($this->parameterValuesArr, $temp);
            $this->reset('parameter_id', 'sub_title');
        }
    }
    public function deleteCart($id)
    {
        unset($this->parameterValuesArr[$id - 1]);
        $this->render();
        session()->flash('message', 'Removed Successfully.');
    }

    public function save()
    {
        // public $department_id,$service_group_id,$service_id,$gender_id,$doctor_id,$lab_equivalent_name,$report_title,$code,$name,$method,$is_gender_specific,
        //$is_sample_needed,$is_default_format,$is_growth,$specimen,$column_cap_1,$column_cap_2,$column_cap_3,$column_cap_4,$is_accrediation_needed,
        //$is_multiple_oranism_needed,$is_clinical_history,$is_no_normal_range,$min_time,$time_ins_min,$max_time,$time_ins_max;
        $formatMaxId = Parameter::max('id');
        $formatCode = 'FMT' . $formatMaxId + 1;
        $format = Format::create([
            'department_id' => $this->department_id,
            'service_group_id' => $this->service_group_id,
            'service_id' => $this->service_id,
            'gender_id' => $this->is_gender_specific ? $this->gender_id : null,
            'doctor_id' => $this->doctor_id ? $this->doctor_id : null,
            'lab_equivalent_name' => $this->lab_equivalent_name,
            'code' => $formatCode,
            'name' => $this->name,
            'method' => $this->method,
            'is_gender_specific' => $this->is_gender_specific,
            'is_sample_needed' => $this->is_sample_needed,
            'is_default_format' => $this->is_default_format,
            'is_growth' => $this->is_growth,

            'specimen' => $this->specimen,

            'column_cap_1' => $this->column_cap_1,
            'column_cap_2' => $this->column_cap_2,
            'column_cap_3' => $this->column_cap_3,
            'column_cap_4' => $this->column_cap_4,

            'is_accrediation_needed' => $this->is_accrediation_needed,
            'is_multiple_oranism_needed' => $this->is_multiple_oranism_needed,
            'is_clinical_history' => $this->is_clinical_history,
            'is_no_normal_range' => $this->is_no_normal_range,

            'min_time' => $this->min_time,
            'time_ins_min' => $this->time_ins_min,
            'max_time' => $this->max_time,
            'time_ins_max' => $this->time_ins_max,

            'is_active' => true,

            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id,
        ]);

        $paramArr = [];
        foreach ($this->parameterValuesArr as $paramValue) {
            $temp = [];
            $temp['format_id'] = $format->id;
            $temp['parameter_id'] = $paramValue['parameter_id'];
            $temp['sub_title'] = $paramValue['sub_title'];

            array_push($paramArr, $temp);
        }
        FormatParameter::insert($paramArr);


        $this->closeModal();
        session()->flash('message', ' Parameter Added Successfully.');
        $this->formats = Format::latest()->get();
    }

    public function closeModal()
    {
        $this->resetExcept('formats', 'departments', 'servicegroups', 'services', 'doctors', 'timins', 'parameters');
    }

    public function render()
    {

        return view('livewire.pathology.format.format-set-up')->extends('layouts.admin')->section('content');
    }
}

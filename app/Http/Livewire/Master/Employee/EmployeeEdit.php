<?php

namespace App\Http\Livewire\Master\Employee;

use App\Models\Bloodgroup;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Designation;
use App\Models\Employee;
use App\Models\EmployeeCategory;
use App\Models\Gender;
use App\Models\Marital;
use App\Models\Nationality;
use App\Models\Relation;
use App\Models\Religion;
use App\Models\Title;
use App\Models\Village;
use Livewire\Component;

class EmployeeEdit extends Component
{
    public $employee_id, $employee_category_id, $employee_code, $title_id, $employee_name, $gender_id, $relation_id, $father_name;
    public $dob, $doj, $religion_id, $nationality_id, $marital_id, $qualification, $qualified_university, $department_id;
    public $designation_id, $is_hod, $cost_center_id, $bloodgroup_id, $mobile, $email, $pincode, $village_id, $address;

    public $categories = [];
    public $titles = [];
    public $genders = [];
    public $religions = [];
    public $nationalities = [];
    public $maritals = [];
    public $relations = [];
    public $departments = [];
    public $designations = [];
    public $cost_centers = [];
    public $bloodgroups = [];
    public $villages = [];

    public function mount($id)
    {
        $this->categories = EmployeeCategory::get();
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->relations = Relation::get();
        $this->religions = Religion::get();
        $this->nationalities = Nationality::get();
        $this->maritals = Marital::get();
        $this->departments = Department::get();
        $this->designations = Designation::get();
        $this->cost_centers = CostCenter::get();
        $this->bloodgroups = Bloodgroup::get();
        $this->villages = Village::oldest()->get();

        $employee = Employee::find($id);
        if ($employee) {
            $this->employee_id = $employee->id;
            $this->employee_category_id = $employee->employee_category_id;
            $this->employee_code = $employee->employee_code;
            $this->title_id = $employee->title_id;
            $this->employee_name = $employee->employee_name;
            $this->gender_id = $employee->gender_id;
            $this->relation_id = $employee->relation_id;
            $this->father_name = $employee->father_name;
            $this->dob = date("Y-m-d", strtotime($employee->dob));
            $this->doj = date("Y-m-d", strtotime($employee->doj));
            $this->religion_id = $employee->religion_id;
            $this->nationality_id = $employee->nationality_id;
            $this->marital_id = $employee->marital_id;
            $this->qualification = $employee->qualification;
            $this->qualified_university = $employee->qualified_university;
            $this->department_id = $employee->department_id;
            $this->designation_id = $employee->designation_id;
            $this->is_hod = $employee->is_hod;
            $this->cost_center_id = $employee->cost_center_id;
            $this->bloodgroup_id = $employee->bloodgroup_id;
            $this->mobile = $employee->mobile;
            $this->email = $employee->email;
            $this->pincode = $employee->pincode;
            $this->village_id = $employee->village_id;
            $this->address = $employee->address;
        }
    }

    public function titleChanged()
    {
        $title = Title::find($this->title_id);
        if ($title) {
            $this->gender_id = $title->gender_id;
        }
    }

    public function genderChanged()
    {
        $title = Title::where("gender_id", $this->gender_id)->first();
        if ($title) {
            $this->title_id = $title->id;
        } else {
            $this->title_id = Title::first()?->id;
        }
    }

    public function villageChanged()
    {
        $village = Village::where("id", $this->village_id)->first();
        if ($village) {
            $this->address = $village->name . ', Block-' . $village?->block?->name . ', District-' . $village?->district->name . ' ,' . $village?->state?->name;
        } else {
            $this->address = null;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function rules()
    {
        return [
            'employee_category_id' => 'required',
            'employee_code' => 'required|unique:employees,employee_code,' . $this->employee_id,
            'title_id' => 'required',
            'employee_name' => 'required',
            'gender_id' => 'required',
            'relation_id' => 'required',
            'father_name' => 'required',
            'dob' => 'required',
            'doj' => 'required',
            'qualification' => 'required',
            'department_id' => 'required',
            'designation_id' => 'required',
            'cost_center_id' => 'required',
            'village_id' => 'required',
            'address' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        $employee = Employee::find($this->employee_id);
        if ($employee) {
            $employee->update([
                'employee_category_id' => $this->employee_category_id,
                'employee_code' => $this->employee_code,
                'title_id' => $this->title_id,
                'employee_name' => $this->employee_name,
                'gender_id' => $this->gender_id,
                'relation_id' => $this->relation_id,
                'father_name' => $this->father_name,
                'dob' => $this->dob,
                'doj' => $this->doj,
                'religion_id' => $this->religion_id,
                'nationality_id' => $this->nationality_id,
                'marital_id' => $this->marital_id,
                'qualification' => $this->qualification,
                'qualified_university' => $this->qualified_university,
                'department_id' => $this->department_id,
                'designation_id' => $this->designation_id,
                'is_hod' => $this->is_hod,
                'cost_center_id' => $this->cost_center_id,
                'bloodgroup_id' => $this->bloodgroup_id,
                'mobile' => $this->mobile,
                'email' => $this->email,
                'pincode' => $this->pincode,
                'village_id' => $this->village_id,
                'address' => $this->address,
                'updated_by_id' => auth()->user()?->id,
            ]);

            session()->flash('success', 'Employee Updated Successfully');
            return redirect()->route('admin.employee');
        }

        session()->flash('error', 'Something went wrong ! Try Again');
    }

    public function render()
    {
        return view('livewire.master.employee.employee-edit')->extends('layouts.admin')->section('content');
    }
}

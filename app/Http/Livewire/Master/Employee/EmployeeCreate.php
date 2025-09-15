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

class EmployeeCreate extends Component
{
    public $employee_category_id, $employee_code, $title_id, $employee_name, $gender_id, $relation_id, $father_name;
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

    public function mount()
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

        $this->title_id = Title::first()?->id;
        $this->gender_id = Gender::first()?->id;
        $this->relation_id = Relation::first()?->id;
        $this->cost_center_id = CostCenter::first()?->id;
    }

    public function titleChanged()
    {
        $title = Title::find($this->title_id);
        if ($title) {
            $this->gender_id = $title?->gender_id;
        }
    }

    public function genderChanged()
    {
        $title = Title::where("gender_id", $this->gender_id)->first();
        if ($title) {
            $this->title_id = $title?->id;
        } else {
            $this->title_id = Title::first()?->id;
        }
    }

    public function villageChanged()
    {
        $village = Village::where("id", $this->village_id)->first();
        if ($village) {
            $this->address = $village->name . ', Block-' . $village?->block?->name . ', District-' . $village?->district?->name . ' ,' . $village?->state?->name;
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
            'employee_code' => 'required|unique:employees,employee_code',
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

        Employee::create([
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
            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Employee Created Successfully');
        return redirect()->route('admin.employee');
    }

    public function render()
    {
        return view('livewire.master.employee.employee-create')->extends('layouts.admin')->section('content');
    }
}

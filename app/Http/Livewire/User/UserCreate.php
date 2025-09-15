<?php

namespace App\Http\Livewire\User;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class UserCreate extends Component
{
    public $employee_id, $employee_name, $department_id, $user_name, $user_id, $password, $password_confirmation;
    public $team_id, $email, $mobile;
    public $employees = [];
    public $departments = [];
    public $teams = [];

    public function mount()
    {
        $this->employees = Employee::doesntHave('user')->latest()->get();
        $this->departments = Department::get();
        $this->teams = Team::get();
    }

    public function employeeChanged()
    {
        $employment = Employee::find($this->employee_id);
        if ($employment) {
            $this->employee_name = $employment->employee_name;
            $this->department_id = $employment->department_id;
            $this->user_name = $employment->employee_name;
            $this->user_id = $employment->employee_code;
            $this->email = $employment->email;
            $this->mobile = $employment->mobile;
        }
    }

    public function save()
    {
        $this->validate([
            'employee_id' => 'required',
            'employee_name' => 'required|string',
            'department_id' => 'required',
            'user_name' => 'required|string|max:255',
            'user_id' => 'required|string',
            'password' => 'required|string|min:1|confirmed',
            'team_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
        ]);

        User::create([
            'employee_id' => $this->employee_id,
            'department_id' => $this->department_id,
            'name' => $this->user_name,
            'user_id' => $this->user_id,
            'password' => $this->password,
            'team_id' => $this->team_id,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);

        return to_route('admin.users.index')->with('success', 'User Created Successfully');
    }

    public function render()
    {
        return view('livewire.user.user-create')->extends('layouts.admin')->section('content');
    }
}

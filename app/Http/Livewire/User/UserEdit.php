<?php

namespace App\Http\Livewire\User;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Team;
use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{
    public $user_find_id, $employee_id, $employee_name, $department_id, $user_name, $user_id, $password, $password_confirmation;
    public $team_id, $email, $mobile, $is_password_change = 0;
    public $employees = [];
    public $departments = [];
    public $teams = [];

    public function mount($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->user_find_id = $user?->id;
            $this->employee_id = $user?->employee_id;
            $this->employee_name = $user?->employee?->employee_name ?? '';
            $this->department_id = $user->department_id;
            $this->user_name = $user->name;
            $this->user_id = $user->user_id;
            $this->email = $user->email;
            $this->mobile = $user->mobile;
            $this->team_id = $user->team_id;
        } else {
            return redirect()->route('admin.users.index')->with('error', 'User not found');
        }

        $this->employees = Employee::where('id', $user->employee_id)->get();
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
            'team_id' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_find_id,
            'password' => $this->is_password_change
                ? 'required|string|min:1|confirmed'
                : 'nullable|string',
        ]);

        $updateData = [
            'employee_id' => $this->employee_id,
            'department_id' => $this->department_id,
            'name' => $this->user_name,
            'user_id' => $this->user_id,
            'team_id' => $this->team_id,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ];

        if ($this->is_password_change) {
            $updateData['password'] = $this->password;
        }

        $user = User::find($this->user_find_id);

        if ($user->team_id == $this->team_id) {
            $user->update($updateData);
            return to_route('admin.users.index')->with('success', 'User Updated Successfully');
        } else {
            $user->update($updateData);
            return to_route('admin.users.sync_team_role', $this->user_find_id);
        }
    }

    public function render()
    {
        return view('livewire.user.user-edit')->extends('layouts.admin')->section('content');
    }
}

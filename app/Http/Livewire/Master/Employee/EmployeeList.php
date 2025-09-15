<?php

namespace App\Http\Livewire\Master\Employee;

use App\Models\Employee;
use Livewire\Component;

class EmployeeList extends Component
{
    public $employees;

    public function mount()
    {
        $this->employees = Employee::latest()->get();
    }

    public function render()
    {
        return view('livewire.master.employee.employee-list')->extends('layouts.admin')->section('content');
    }
}

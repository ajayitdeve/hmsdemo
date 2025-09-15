<?php

namespace App\Http\Livewire\Master\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentMaster extends Component
{
    public $name, $code, $is_medical = true, $is_nmch = true, $is_consultation = true;
    public $department_id;

    public function rules()
    {
        return [
            'name' => 'required|unique:departments',
            'code' => 'required|unique:departments',
            'is_medical' => 'required',
            'is_consultation' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        $department = new Department;
        $department->name = $this->name;
        $department->code = $this->code;
        $department->is_medical = $this->is_medical;
        $department->is_nmch = $this->is_nmch;
        $department->is_consultation = $this->is_consultation;
        $department->save();

        session()->flash('message', 'Department Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $department_id)
    {
        $department = Department::find($department_id);
        if ($department) {
            $this->department_id = $department->id;
            $this->name = $department->name;
            $this->code = $department->code;
            $this->is_medical = $department->is_medical;
            $this->is_consultation = $department->is_consultation;
            $this->is_nmch = $department->is_nmch;
        } else {
        }
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|unique:departments,name,' . $this->department_id,
            'code' => 'required|unique:departments,code,' . $this->department_id,
            'is_medical' => 'required',
            'is_consultation' => 'required'
        ]);

        Department::where('id', $this->department_id)->update(
            [
                'name' => $this->name,
                'code' => $this->code,
                'is_medical' => $this->is_medical,
                'is_nmch' => $this->is_nmch,
                'is_consultation' => $this->is_consultation
            ]
        );
        session()->flash('message', 'Department Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $department_id)
    {
        $this->department_id = $department_id;
    }

    public function destroy()
    {
        Department::find($this->department_id)->delete();
        session()->flash('message', 'Department deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset();
    }
    public function resetInput()
    {
        $this->name = '';
        $this->code = '';
        $this->department_id = null;
    }
    public function render()
    {
        $departments = Department::orderBy('id', 'DESC')->get();
        return view('livewire.master.department.department-master', ['departments' => $departments])->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Master\Unit;

use App\Models\Department;
use App\Models\Unit;
use Livewire\Component;

class UnitMaster extends Component
{
    public $name, $unit_id, $department_id, $departments, $user;

    public function mount()
    {

        $this->departments = Department::get();
        $this->user = Auth()->user();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'department_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Unit::create([
            'name' => $this->name,
            'department_id' => $this->department_id,
            'created_by_id' => $this->user->id
        ]);

        session()->flash('message', 'Unit Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $unit_id)
    {
        $unit = Unit::find($unit_id);
        if ($unit) {
            $this->unit_id = $unit_id;
            $this->department_id = $unit->department_id;
            $this->name = $unit->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        Unit::where('id', $this->unit_id)->update(['name' => $validatedData['name'], 'department_id' => $validatedData['department_id']]);
        session()->flash('message', 'Unit Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $unit_id)
    {
        $this->unit_id = $unit_id;
    }

    public function destroy()
    {
        Unit::find($this->unit_id)->delete();
        session()->flash('message', 'Unit delete Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->name = '';
    }

    public function render()
    {
        $units = Unit::whereHas('department')->latest()->get();

        return view('livewire.master.unit.unit-master', ['units' => $units])->extends('layouts.admin')->section('content');
    }
}

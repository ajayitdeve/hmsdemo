<?php

namespace App\Http\Livewire\Service\ServiceGroup;

use Livewire\Component;
use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;

class ServiceGroupMaster extends Component
{

    public $department_id, $code, $name;
    public $service_group_id, $departments = [];

    protected function rules()
    {
        return [
            'department_id' => 'required',
            'code' => 'required',
            'name' => 'required',
        ];
    }
    public function mount()
    {
        $this->departments = Department::all();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        ServiceGroup::create([
            'department_id' => $this->department_id,
            'code' => $this->code,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Service Group Created  Successfully.');
        $this->resetExcept('departments');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $service_group_id)
    {
        $serviceGroup = ServiceGroup::find($service_group_id);
        if ($serviceGroup) {
            $this->service_group_id = $serviceGroup->id;
            $this->department_id = $serviceGroup->department_id;
            $this->code = $serviceGroup->code;
            $this->name = $serviceGroup->name;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        ServiceGroup::where('id', $this->service_group_id)->update([
            'department_id' => $this->department_id,
            'code' => $this->code,
            'name' => $this->name,

        ]);

        session()->flash('message', ' Service Group Edited Successfully.');
        $this->resetExcept('departments');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $service_group_id)
    {
        $this->service_group_id = $service_group_id;
    }

    public function destroy()
    {
        ServiceGroup::find($this->service_group_id)->delete();
        $this->resetExcept('departments');
        $this->dispatchBrowserEvent('close-modal');
        session()->flash('message', 'Service Group deleted Successfully.');
    }

    public function render()
    {
        $serviceGroups = ServiceGroup::orderBy('id', 'DESC')->get();
        return view('livewire.service.service-group.service-group-master', ['serviceGroups' => $serviceGroups])->extends('layouts.admin')->section('content');
    }
}

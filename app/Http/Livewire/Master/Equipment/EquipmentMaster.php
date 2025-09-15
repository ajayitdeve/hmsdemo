<?php

namespace App\Http\Livewire\Master\Equipment;

use App\Models\Equipment;
use App\Models\EquipmentGroup;
use Livewire\Component;
use Illuminate\Validation\Rule;

class EquipmentMaster extends Component
{
    public $equipment_id, $equipment_group_id, $name, $code;
    public $equipment_groups = [];
    public $equipments = [];

    public function mount()
    {
        $this->equipment_groups = EquipmentGroup::all();
        $this->equipments = Equipment::latest()->get();
    }

    public function rules()
    {
        return [
            'equipment_group_id' => ['required'],
            'name' => [
                'required',
                Rule::unique('equipment', 'name')->ignore($this->equipment_id),
            ],
            'code' => [
                'required',
                Rule::unique('equipment', 'code')->ignore($this->equipment_id),
            ],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['created_by_id'] = auth()->user()?->id;
        Equipment::create($validatedData);

        session()->flash('message', 'Equipment Added Successfully.');
        $this->reset(['equipment_id', 'equipment_group_id', 'name', 'code']);
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $equipment_id)
    {
        $equipment = Equipment::find($equipment_id);
        if ($equipment) {
            $this->equipment_id = $equipment_id;
            $this->equipment_group_id = $equipment->equipment_group_id;
            $this->name = $equipment->name;
            $this->code = $equipment->code;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Equipment::where('id', $this->equipment_id)->update($validatedData);

        session()->flash('message', 'Equipment Edited Successfully.');
        $this->reset(['equipment_id', 'equipment_group_id', 'name', 'code']);
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $equipment_id)
    {
        $this->equipment_id = $equipment_id;
    }

    public function destroy()
    {
        Equipment::find($this->equipment_id)->delete();

        session()->flash('message', 'Equipment delete Successfully.');
        $this->reset(['equipment_id', 'equipment_group_id', 'name', 'code']);
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset(['equipment_id', 'equipment_group_id', 'name', 'code']);
    }

    public function render()
    {
        return view('livewire.master.equipment.equipment-master')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Master\Equipment;

use App\Models\EquipmentGroup;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class EquipmentGroupMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $equipment_group_id, $name, $code;

    public function mount() {}

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('equipment_groups', 'name')->ignore($this->equipment_group_id),
            ],
            'code' => [
                'required',
                Rule::unique('equipment_groups', 'code')->ignore($this->equipment_group_id),
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
        EquipmentGroup::create($validatedData);

        session()->flash('message', 'Equipment Group Added Successfully.');
        $this->reset(['equipment_group_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $equipment_group_id)
    {
        $equipment_group = EquipmentGroup::find($equipment_group_id);
        if ($equipment_group) {
            $this->equipment_group_id = $equipment_group_id;
            $this->name = $equipment_group->name;
            $this->code = $equipment_group->code;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        EquipmentGroup::where('id', $this->equipment_group_id)->update($validatedData);

        session()->flash('message', 'Equipment Group Edited Successfully.');
        $this->reset(['equipment_group_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $equipment_group_id)
    {
        $this->equipment_group_id = $equipment_group_id;
    }

    public function destroy()
    {
        EquipmentGroup::find($this->equipment_group_id)->delete();

        session()->flash('message', 'Equipment group delete Successfully.');
        $this->reset(['equipment_group_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset(['equipment_group_id', 'name', 'code']);
    }

    public function render()
    {
        $equipment_groups = EquipmentGroup::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.equipment.equipment-group-master', compact('equipment_groups'))->extends('layouts.admin')->section('content');
    }
}

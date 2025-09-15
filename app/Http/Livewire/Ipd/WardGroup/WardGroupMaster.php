<?php

namespace App\Http\Livewire\Ipd\WardGroup;

use Livewire\Component;
use App\Models\Ipd\WardGroup;
use App\Models\Ipd\WardTariff;
use Illuminate\Support\Facades\Auth;

class WardGroupMaster extends Component
{
    public $code, $name, $status, $ward_tariff_id, $created_by_id, $updated_by_id, $ward_group_id, $wardGroups = [], $wardTariffs = [];
    public function mount()
    {
        $this->wardGroups = WardGroup::get();
        $this->wardTariffs = WardTariff::get();
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'ward_tariff_id' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();
        $lastWardGroup = WardGroup::max('id');
        $wardGroup = new WardGroup;
        $wardGroup->name = $this->name;
        $wardGroup->code = 'WG' . $lastWardGroup;
        $wardGroup->status = 1;
        $wardGroup->ward_tariff_id = $this->ward_tariff_id;
        $wardGroup->created_by_id = Auth::user()?->id;
        $wardGroup->updated_by_id = Auth::user()?->id;
        $wardGroup->save();
        session()->flash('message', 'Ward Group Added Successfully.');
        $this->resetExcept('wardGroups', 'wardTariffs');
        $this->wardGroups = WardGroup::get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $ward_group_id)
    {
        $wardGroup = WardGroup::find($ward_group_id);
        if ($wardGroup) {
            $this->ward_group_id = $wardGroup->id;
            $this->name = $wardGroup->name;
            $this->code = $wardGroup->code;
            $this->status = $wardGroup->status;
            $this->ward_tariff_id = $wardGroup->ward_tariff_id;
            $this->created_by_id = $wardGroup->created_by_id;
            $this->updated_by_id = $wardGroup->updated_by_id;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        WardGroup::where('id', $this->ward_group_id)->update(
            [
                'name' => $this->name,
                'code' => $this->code,
                'ward_tariff_id' => $this->ward_tariff_id,
                'status' => $this->status,
                'created_by_id' => $this->created_by_id,
                'updated_by_id' => Auth::user()?->id
            ]
        );
        session()->flash('message', 'Ward Group Edited Successfully.');
        $this->resetExcept('wardGroups', 'wardTariffs');
        $this->dispatchBrowserEvent('close-modal');
        $this->wardGroups = WardGroup::get();
    }


    public function delete(int $ward_group_id)
    {
        $this->ward_group_id = $ward_group_id;
    }

    public function destroy()
    {
        $wardGroup = WardGroup::find($this->ward_group_id)->delete();
        session()->flash('message', 'Ward Group deleted Successfully.');
        $this->resetExcept('wardGroups', 'wardTariffs');
        $this->dispatchBrowserEvent('close-modal');
        $this->wardGroups = WardGroup::get();
    }

    public function closeModal()
    {
        $this->resetExcept('wardGroups', 'wardTariffs');
        $this->wardGroups = WardGroup::get();
    }
    public function resetInput() {}
    public function render()
    {
        return view('livewire.ipd.ward-group.ward-group-master')->extends('layouts.admin')->section('content');
    }
}

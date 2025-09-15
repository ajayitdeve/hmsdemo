<?php

namespace App\Http\Livewire\Ipd\Ward;

use Livewire\Component;
use App\Models\Ipd\Ward;
use App\Models\Ipd\WardGroup;
use App\Models\Ipd\WardTariff;
use Illuminate\Support\Facades\Auth;

class WardMaster extends Component
{
    public $code, $name, $display_name, $status, $priority = 0, $is_casuality, $ward_tariff_id, $ward_group_id, $created_by_id, $updated_by_id, $ward_id, $wards = [], $wardTariffs = [], $wardGroups = [];

    public function mount()
    {
        $this->wards = Ward::get();
        $this->wardGroups = WardGroup::get();
        $this->wardTariffs = WardTariff::get();
        $this->status = 1;
        $this->is_casuality = false;
    }
    public function rules()
    {
        return [
            'name' => 'required',
            'ward_group_id' => 'required',
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
        $lastward = Ward::max('id');
        $ward = new Ward;
        $ward->name = $this->name;
        $ward->code = 'W' . $lastward;
        $ward->status = $this->status;
        $ward->is_casuality = $this->is_casuality ? true : false;
        $ward->ward_tariff_id = $this->ward_tariff_id;
        $ward->ward_group_id = $this->ward_group_id;
        $ward->created_by_id = Auth::user()?->id;
        $ward->updated_by_id = Auth::user()?->id;
        $ward->save();

        session()->flash('message', 'Ward  Added Successfully.');
        $this->resetExcept('wards', 'wardTariffs', 'wardGroups');
        $this->wards = Ward::get();
        $this->status = 1;
        $this->is_casuality = false;
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $ward_group_id)
    {
        $ward = Ward::find($ward_group_id);
        if ($ward) {
            $this->ward_id = $ward->id;
            $this->name = $ward->name;
            $this->code = $ward->code;
            $this->status = $ward->status;
            $this->is_casuality = $ward->is_casuality ? true : false;
            $this->priority = $ward->priority;
            $this->ward_tariff_id = $ward->ward_tariff_id;
            $this->ward_group_id = $ward->ward_group_id;
            $this->created_by_id = $ward->created_by_id;
            $this->updated_by_id = $ward->updated_by_id;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        ward::where('id', $this->ward_group_id)->update(
            [
                'name' => $this->name,
                'code' => $this->code,
                'ward_tariff_id' => $this->ward_tariff_id,
                'ward_group_id' => $this->ward_group_id,
                'status' => $this->status,
                'priority' => $this->priority,
                'is_casuality' => $this->is_casuality ? true : false,
                'created_by_id' => $this->created_by_id,
                'updated_by_id' => Auth::user()?->id
            ]
        );

        session()->flash('message', 'Ward  Edited Successfully.');
        $this->resetExcept('wards', 'wardTariffs', 'wardGroups');
        $this->dispatchBrowserEvent('close-modal');
        $this->wards = Ward::get();
        $this->status = 1;
        $this->is_casuality = false;
    }


    public function delete(int $ward_group_id)
    {
        $this->ward_group_id = $ward_group_id;
    }

    public function destroy()
    {
        Ward::find($this->ward_group_id)->delete();

        session()->flash('message', 'Ward  deleted Successfully.');
        $this->resetExcept('wards', 'wardTariffs', 'wardGroups');
        $this->dispatchBrowserEvent('close-modal');
        $this->wards = Ward::get();
        $this->status = 1;
        $this->is_casuality = false;
    }

    public function closeModal()
    {
        $this->resetExcept('wards', 'wardTariffs', 'wardGroups');
        $this->wards = Ward::get();
        $this->status = 1;
        $this->is_casuality = false;
    }

    public function resetInput() {}

    public function render()
    {
        return view('livewire.ipd.ward.ward-master')->extends('layouts.admin')->section('content');
    }
}

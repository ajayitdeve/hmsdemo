<?php

namespace App\Http\Livewire\Ipd\WardTariff;

use Livewire\Component;
use App\Models\Ipd\WardTariff;
use Illuminate\Support\Facades\Auth;

class WardTariffMaster extends Component
{
    public $code, $name, $created_by_id, $updated_by_id, $ward_tariff_id, $wardTariffs = [];
    public function mount()
    {
        $this->wardTariffs = WardTariff::get();
    }
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();
        $wardTariff = WardTariff::max('id');
        $wardTariff = new WardTariff;
        $wardTariff->name = $this->name;
        $wardTariff->code = $this->name[0];
        $wardTariff->created_by_id = Auth::user()?->id;
        $wardTariff->updated_by_id = Auth::user()?->id;
        $wardTariff->save();
        session()->flash('message', 'Ward Tariff Added Successfully.');
        $this->resetExcept('wardTariffs');
        $this->WardTariffs = WardTariff::get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $ward_tariff_id)
    {
        $wardTariff = WardTariff::find($ward_tariff_id);
        if ($wardTariff) {
            $this->ward_tariff_id = $wardTariff->id;
            $this->name = $wardTariff->name;
            $this->code = $wardTariff->code;
            $this->created_by_id = $wardTariff->created_by_id;
            $this->updated_by_id = $wardTariff->updated_by_id;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        WardTariff::where('id', $this->ward_tariff_id)->update(
            [
                'name' => $this->name,
                'code' => $this->code
            ]
        );
        session()->flash('message', 'Ward Tariff Edited Successfully.');
        $this->resetExcept('WardTariffs');
        $this->dispatchBrowserEvent('close-modal');
        $this->wardTariffs = WardTariff::get();
    }


    public function delete(int $ward_tariff_id)
    {
        $this->ward_tariff_id = $ward_tariff_id;
    }

    public function destroy()
    {
        $wardTariff = WardTariff::find($this->ward_tariff_id)->delete();
        session()->flash('message', 'Ward Tariff  deleted Successfully.');
        $this->resetExcept('WardTariffs');
        $this->dispatchBrowserEvent('close-modal');
        $this->wardTariffs = WardTariff::get();
    }

    public function closeModal()
    {
        $this->resetExcept('wardTariffs');
        $this->WardTariffs = WardTariff::get();
    }
    public function resetInput() {}

    public function render()
    {
        return view('livewire.ipd.ward-tariff.ward-tariff-master')->extends('layouts.admin')->section('content');
    }
}

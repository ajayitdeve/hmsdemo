<?php

namespace App\Http\Livewire\AddressMaster;

use App\Models\Country;
use Livewire\Component;

class CountryMaster extends Component
{
    public $name, $country_id, $countries = [];

    public function mount()
    {
        $this->countries = Country::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:countries',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Country::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Country Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $country_id)
    {
        $country = Country::find($country_id);
        if ($country) {
            $this->country_id = $country->id;
            $this->name = $country->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Country::where('id', $this->country_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Country Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $country_id)
    {
        $this->country_id = $country_id;
    }

    public function destroy()
    {
        Country::find($this->country_id)->delete();
        session()->flash('message', 'Country  delete Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.address-master.country-master')->extends('layouts.admin')->section('content');
    }
}

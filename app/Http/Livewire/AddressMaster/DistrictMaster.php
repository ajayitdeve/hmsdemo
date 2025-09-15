<?php

namespace App\Http\Livewire\AddressMaster;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\District;

class DistrictMaster extends Component
{
    public $name, $state_id, $country_id, $district_id, $states = [], $countries = [], $districts = [];

    public function mount()
    {
        $this->countries = Country::all();
        $this->states = State::all();
        $this->districts = District::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        District::create([
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'District  Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $district_id)
    {
        $district = District::find($district_id);

        if ($district) {
            $this->country_id = $district->country_id;
            $this->state_id = $district->state_id;
            $this->district_id = $district->id;
            $this->name = $district->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        District::where('id', $this->district_id)->update([
            'name' => $validatedData['name'],
            'country_id' => $validatedData['country_id'],
            'state_id' => $validatedData['state_id']
        ]);

        session()->flash('message', 'District Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $district_id)
    {
        $this->district_id = $district_id;
    }

    public function destroy()
    {
        District::find($this->district_id)->delete();
        session()->flash('message', 'District  delete Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function countryChanged()
    {
        $this->states = State::where('country_id', $this->country_id)->get();
    }

    public function render()
    {
        return view('livewire.address-master.district-master')->extends('layouts.admin')->section('content');
    }
}

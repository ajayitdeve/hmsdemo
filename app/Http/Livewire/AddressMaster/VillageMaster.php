<?php

namespace App\Http\Livewire\AddressMaster;

use App\Models\Block;
use App\Models\State;
use App\Models\Country;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use Livewire\WithPagination;

class VillageMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $village_id, $name, $state_id, $country_id, $district_id, $block_id, $states = [], $countries = [], $districts = [], $blocks = [];

    public function mount()
    {
        $this->states = State::get();
        $this->countries = Country::get();
        $this->districts = District::get();
        $this->blocks = Block::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required',
            'block_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Village::create([
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'district_id' => $this->district_id,
            'block_id' => $this->block_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Village Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $village_id)
    {
        $village = Village::find($village_id);

        if ($village) {
            $this->country_id = $village->country_id;
            $this->state_id = $village->state_id;
            $this->district_id = $village->district_id;
            $this->block_id = $village->block_id;
            $this->village_id = $village->id;
            $this->name = $village->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        Village::where('id', $this->village_id)->update([
            'name' => $validatedData['name'],
            'country_id' => $validatedData['country_id'],
            'state_id' => $validatedData['state_id'],
            'district_id' => $validatedData['district_id'],
            'block_id' => $validatedData['block_id']
        ]);

        session()->flash('message', 'Village Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $block_id)
    {
        $this->block_id = $block_id;
    }

    public function destroy()
    {
        Block::find($this->block_id)->delete();
        session()->flash('message', 'Village  deleted Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function countryChanged()
    {
        $this->states = State::where('country_id', $this->country_id)->get();
    }

    public function stateChanged()
    {

        $this->districts = District::where('state_id', $this->state_id)->get();
    }

    public function districtChanged()
    {

        $this->blocks = Block::where('district_id', $this->district_id)->get();
    }

    public function render()
    {
        $villages = Village::latest()->paginate(10);

        return view('livewire.address-master.village-master', ['villages' => $villages])->extends('layouts.admin')->section('content');
    }
}

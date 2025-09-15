<?php

namespace App\Http\Livewire\AddressMaster;

use App\Models\Block;
use App\Models\State;
use App\Models\Country;
use Livewire\Component;
use App\Models\District;

class BlockMaster extends Component
{
    public $name, $state_id, $country_id, $district_id, $block_id, $states = [], $countries = [], $districts = [], $blocks = [];


    public function mount()
    {
        $this->states = State::all();
        $this->countries = Country::all();
        $this->districts = District::all();
        $this->blocks = Block::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'district_id' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        Block::create([
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'district_id' => $this->district_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Block  Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $block_id)
    {
        $block = Block::find($block_id);

        if ($block) {
            $this->country_id = $block->country_id;
            $this->state_id = $block->state_id;
            $this->district_id = $block->district_id;
            $this->block_id = $block->id;
            $this->name = $block->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();

        Block::where('id', $this->block_id)->update([
            'name' => $validatedData['name'],
            'country_id' => $validatedData['country_id'],
            'state_id' => $validatedData['state_id'],
            'district_id' => $validatedData['district_id']

        ]);

        session()->flash('message', 'Block Edited Successfully.');
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
        session()->flash('message', 'Block  delete Successfully.');
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

    public function render()
    {
        return view('livewire.address-master.block-master')->extends('layouts.admin')->section('content');
    }
}

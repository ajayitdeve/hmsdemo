<?php

namespace App\Http\Livewire\AddressMaster;

use App\Models\State;
use App\Models\Country;
use Livewire\Component;

class StateMaster extends Component
{
    public $name, $state_id, $country_id, $states = [], $countries = [];

    public function mount()
    {
        $this->states = State::all();
        $this->countries = Country::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:states',
            'country_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        State::create([
            'country_id' => $this->country_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'State Added Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $state_id)
    {
        $state = State::find($state_id);
        if ($state) {
            $this->state_id = $state->id;
            $this->name = $state->name;
            $this->country_id = $state->country_id;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        State::where('id', $this->state_id)->update([
            'name' => $validatedData['name'],
            'country_id' => $validatedData['country_id']
        ]);

        session()->flash('message', 'State Edited Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $state_id)
    {
        $this->state_id = $state_id;
    }

    public function destroy()
    {
        State::find($this->state_id)->delete();
        session()->flash('message', 'State  delete Successfully.');
        $this->reset();
        $this->mount();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.address-master.state-master')->extends('layouts.admin')->section('content');
    }
}

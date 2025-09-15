<?php

namespace App\Http\Livewire\Master\Location;

use App\Models\Service\Location;
use Livewire\Component;

class LocationMaster extends Component
{
    public $location_id, $name, $code;

    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required'
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();

        Location::create([
            'name' => $this->name,
            'code' => $this->code,

        ]);

        session()->flash('message', 'Location Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $location_id)
    {
        $location = Location::find($location_id);
        if ($location) {
            $this->location_id = $location_id;
            $this->name = $location->name;
            $this->code = $location->code;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        Location::where('id', $this->location_id)->update(['name' => $this->name, 'code' => $this->code]);
        session()->flash('message', 'Location Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $location_id)
    {
        $this->location_id = $location_id;
    }

    public function destroy()
    {
        Location::find($this->location_id)->delete();
        session()->flash('message', 'Location delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function closeModal()
    {
        $this->reset();
    }
    public function resetInput()
    {
        $this->name = '';
    }

    public function render()
    {
        $locations = Location::orderBy('id', 'DESC')->get();
        return view('livewire.master.location.location-master', ['locations' => $locations])->extends('layouts.admin')->section('content');
    }
}

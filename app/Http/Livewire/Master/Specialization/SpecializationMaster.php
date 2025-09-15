<?php

namespace App\Http\Livewire\Master\Specialization;

use App\Models\Specialization;
use Livewire\Component;

class SpecializationMaster extends Component
{
    public $name;
    public $specialization_id;
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

        Specialization::create([
            "name" => $this->name
        ]);

        session()->flash('message', 'Specialization Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $specialization_id)
    {
        $specialization = Specialization::find($specialization_id);
        if ($specialization) {
            $this->specialization_id = $specialization_id;
            $this->name = $specialization->name;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        Specialization::where('id', $this->specialization_id)->update(['name' => $this->name]);
        session()->flash('message', 'Specialization Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $specialization_id)
    {
        $this->specialization_id = $specialization_id;
    }

    public function destroy()
    {
        Specialization::find($this->specialization_id)->delete();
        session()->flash('message', 'Specialization deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset();
    }

    public function render()
    {
        $specializations = Specialization::orderBy('id', 'DESC')->get();
        return view('livewire.master.specialization.specialization-master', ['specializations' => $specializations])->extends('layouts.admin')->section('content');
    }
}

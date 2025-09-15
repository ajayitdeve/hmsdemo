<?php

namespace App\Http\Livewire\Pathology\Specimen;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use \App\Models\Pathology\SpecimenMaster as Specimen;

class SpecimenMaster extends Component
{


    public $specimens = [], $specimen_master_id;
    public $code, $name, $s1_cd, $s2_cd, $is_active = true, $created_by_id, $updated_by_id;

    public function mount()
    {
        $this->specimens = Specimen::latest()->get();
    }

    protected function rules()
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
        $validatedData = $this->validate();
        $specimenMaxId = Specimen::max('id');
        $specimenCode = 'SPC' . $specimenMaxId + 1;
        //`code`, `name`, `s1_cd`, `s2_cd`, `is_active`, `created_by_id`, `updated_by_id`
        $specimen = Specimen::create([
            'name' => $this->name,
            'code' => $specimenCode,
            's1_cd' => $this->s1_cd,
            's2_cd' => $this->s2_cd,
            'is_active' => $this->is_active,
            'created_by_id' => Auth::user()?->id,
            'updatedby_id' => Auth::user()?->id,
        ]);
        //dd($antibiotic);
        if ($specimen) {
            session()->flash('message', 'Specimen Added Successfully.');
            $this->resetExcept('specimens');
            $this->dispatchBrowserEvent('close-modal');
            $this->specimens = Specimen::orderBy('id', 'desc')->get();
        }
    }

    public function edit(int $specimen_master_id)
    {
        $specimen = Specimen::find($specimen_master_id);
        if ($specimen) {
            $this->specimen_master_id = $specimen->id;
            $this->name = $specimen->name;
            $this->s1_cd = $specimen->s1_cd;
            $this->s2_cd = $specimen->s2_cd;
            $this->is_active = $specimen->is_active;
        }
    }

    public function update()
    {
        Specimen::where('id', $this->specimen_master_id)->update([
            'name' => $this->name,
            's1_cd' => $this->s1_cd,
            's2_cd' => $this->s2_cd,
            'is_active' => $this->is_active

        ]);
        session()->flash('message', 'Specimen Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
        $this->specimens = Specimen::orderBy('id', 'desc')->get();
    }

    public function delete(int $specimen_master_id)
    {
        $this->specimen_master_id = $specimen_master_id;
    }

    public function destroy()
    {
        Specimen::find($this->specimen_master_id)->delete();
        session()->flash('message', 'Specimen deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
        $this->specimens = Specimen::orderBy('id', 'desc')->get();
    }

    public function closeModal()
    {
        $this->resetExcept('specimens');
    }

    public function render()
    {
        return view('livewire.pathology.specimen.specimen-master')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Pathology\Antibiotic;

use Livewire\Component;
use App\Models\Pathology\Antibiotic;
use Illuminate\Support\Facades\Auth;

class AntibiometicMaster extends Component
{

    public $antibiotics = [];
    public  $code, $name, $senstive, $moderate, $resistance, $is_active, $created_by_id, $updated_by_id;
    public $antibiotic_id;

    public function mount()
    {
        $this->antibiotics = Antibiotic::latest()->get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'senstive' => 'required',
            'moderate' => 'required',
            'resistance' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        $antibioticMaxId = Antibiotic::max('id');
        $antibioticCode = 'ATB' . $antibioticMaxId + 1;
        // `code`, `name`, `senstive`, `moderate`, `resistance`, `is_active`, `created_by_id`, `updated_by_id`
        $antibiotic = Antibiotic::create([
            'name' => $this->name,
            'senstive' => $this->senstive,
            'resistance' => $this->resistance,
            'moderate' => $this->moderate,
            'code' => $antibioticCode,
            'is_active' => $this->is_active,
            'created_by_id' => Auth::user()?->id,
            'updatedby_id' => Auth::user()?->id,
        ]);
        //dd($antibiotic);
        if ($antibiotic) {
            session()->flash('message', 'Antibiotic Added Successfully.');
            $this->resetExcept('antibiotics');
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function closeModal()
    {
        $this->resetExcept('antibiotics');
    }

    public function edit(int $antibiotic_id)
    {
        $this->antibiotic_id = $antibiotic_id;
        $antibiotic = Antibiotic::find($antibiotic_id);
        //   dd($antibiotic);
        if ($antibiotic) {
            $this->name = $antibiotic['name'];
            $this->senstive = $antibiotic['senstive'];
            $this->resistance = $antibiotic['resistance'];
            $this->moderate = $antibiotic['moderate'];
            $this->code = $antibiotic['code'];
            $this->is_active = $antibiotic['is_active'];
        }
    }

    public function update()
    {
        Antibiotic::find($this->antibiotic_id)->update([
            'name' => $this->name,
            'senstive' => $this->senstive,
            'resistance' => $this->resistance,
            'moderate' => $this->moderate,
            'code' => $this->code,
            'is_active' => $this->is_active,
        ]);
        session()->flash('message', 'Antibiotic Updated Successfully.');
        $this->reset(['name', 'senstive', 'resistance', 'moderate', 'code', 'is_active']);
        $this->antibiotics = Antibiotic::get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $antibiotic_id)
    {
        $this->antibiotic_id = $antibiotic_id;
    }

    public function destroy()
    {
        Antibiotic::find($this->antibiotic_id)->delete();
        session()->flash('message', 'Antibiotic deleted  Successfully.');
        $this->reset(['name', 'senstive', 'resistance', 'moderate', 'code', 'is_active']);
        $this->antibiotics = Antibiotic::get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.pathology.antibiotic.antibiometic-master')->extends('layouts.admin')->section('content');
    }
}

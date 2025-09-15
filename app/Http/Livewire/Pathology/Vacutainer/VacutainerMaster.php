<?php

namespace App\Http\Livewire\Pathology\Vacutainer;

use App\Models\Pathology\Vacutainer;
use Livewire\Component;

class VacutainerMaster extends Component
{
    public $vacutainers = [], $vacutainer_id;
    public $name;

    public function mount()
    {
        $this->vacutainers = Vacutainer::latest()->get();
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

        $this->validate();
        $vacutainer = Vacutainer::create([
            'name' => $this->name,
        ]);
        // dd($vacutainer);

        if ($vacutainer) {
            session()->flash('message', 'vacutainer Added Successfully.');
            $this->resetExcept('vacutainers');
            $this->dispatchBrowserEvent('close-modal');
            $this->vacutainers = Vacutainer::orderBy('id', 'desc')->get();
        }
    }

    public function edit(int $vacutainer_id)
    {
        $vacutainer = Vacutainer::find($vacutainer_id);
        if ($vacutainer) {
            $this->vacutainer_id = $vacutainer->id;
            $this->name = $vacutainer->name;
        } else {
        }
    }

    public function update()
    {
        $this->validate();
        Vacutainer::where('id', $this->vacutainer_id)->update([
            'name' => $this->name,
        ]);
        session()->flash('message', ' vacutainer Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
        $this->vacutainers = Vacutainer::orderBy('id', 'desc')->get();
    }

    public function delete(int $vacutainer_id)
    {
        $this->vacutainer_id = $vacutainer_id;
    }

    public function destroy()
    {
        Vacutainer::find($this->vacutainer_id)->delete();
        session()->flash('message', 'vacutainer deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
        $this->vacutainers = Vacutainer::orderBy('id', 'desc')->get();
    }

    public function closeModal()
    {
        $this->resetExcept('vacutainers');
    }

    public function render()
    {
        return view('livewire.pathology.vacutainer.vacutainer-master')->extends('layouts.admin')->section('content');;
    }
}

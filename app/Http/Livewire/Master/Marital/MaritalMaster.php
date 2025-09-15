<?php

namespace App\Http\Livewire\Master\Marital;

use App\Models\Marital;
use Livewire\Component;
use Livewire\WithPagination;

class MaritalMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $marital_id;

    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required|unique:genders',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $this->validate();
        Marital::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Marital Status Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $marital_id)
    {
        $gender = Marital::find($marital_id);
        if ($gender) {
            $this->marital_id = $gender->id;
            $this->name = $gender->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Marital::where('id', $this->marital_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Marital Status Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $marital_id)
    {
        $this->marital_id = $marital_id;
    }

    public function destroy()
    {
        Marital::find($this->marital_id)->delete();
        session()->flash('message', 'Marital Status delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $maritals = Marital::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.marital.marital-master', ['maritals' => $maritals])->extends('layouts.admin')->section('content');
    }
}

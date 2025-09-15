<?php

namespace App\Http\Livewire\Master\Gender;

use App\Models\Gender;
use Livewire\Component;
use Livewire\WithPagination;

class GenderMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name, $gender_id;


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
        Gender::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Gender Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $gender_id)
    {
        $gender = Gender::find($gender_id);
        if ($gender) {
            $this->gender_id = $gender->id;
            $this->name = $gender->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Gender::where('id', $this->gender_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Gender Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $gender_id)
    {
        $this->gender_id = $gender_id;
    }

    public function destroy()
    {
        Gender::find($this->gender_id)->delete();
        session()->flash('message', 'Gender delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $genders = Gender::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.gender.gender-master', ['genders' => $genders])->extends('layouts.admin')->section('content');
    }
}

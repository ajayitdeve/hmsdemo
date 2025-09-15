<?php

namespace App\Http\Livewire\Master\Religion;

use App\Models\Religion;
use Livewire\Component;
use Livewire\WithPagination;

class ReligionMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $religion_id;

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
        Religion::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Religion Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $religion_id)
    {
        $religion = Religion::find($religion_id);
        if ($religion) {
            $this->religion_id = $religion->id;
            $this->name = $religion->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Religion::where('id', $this->religion_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'ReligionEdited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $religion_id)
    {
        $this->religion_id = $religion_id;
    }

    public function destroy()
    {
        Religion::find($this->religion_id)->delete();
        session()->flash('message', 'Religion  delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $religions = Religion::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.religion.religion-master', ['religions' => $religions])->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Master\Specialist;

use App\Models\Specialist;
use Livewire\Component;
use Livewire\WithPagination;

class SpecialistMaster extends Component
{
    use WithPagination;
    public $name, $code;

    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $validatedData = $this->validate();
        $specialist = new Specialist;
        $specialist->name = $this->name;
        $specialist->code = $this->code;
        $specialist->created_by_id = Auth()->user()?->id;
        $specialist->save();

        session()->flash('message', 'Specialist Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function resetInput()
    {
        $this->name = '';
        $this->code = '';
        $this->status = 0;
    }
    public function render()
    {
        $specialists = Specialist::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.master.specialist.specialist-master', ['specialists' => $specialists])->extends('layouts.admin')->section('content');
    }
}

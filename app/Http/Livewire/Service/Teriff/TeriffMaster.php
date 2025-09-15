<?php

namespace App\Http\Livewire\Service\Teriff;

use Livewire\Component;
use App\Models\Service\Teriff;
use Illuminate\Support\Facades\Auth;

class TeriffMaster extends Component
{
    public $code, $name,  $from, $to, $isneverexpired = false;
    public $teriff_id, $user;

    public function mount()
    {
        $this->isneverexpired = false;
        $this->user = Auth()->user();
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:teriffs',
            'from' => 'required',
            'to' => ''
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        if ($this->isneverexpired) {
            Teriff::create([
                'code' => $this->getCode(),
                'name' => $this->name,
                'contact_person' => Auth::user()?->id,
                'from' => $this->from,
                'to' => null,
                'isneverexpired' => true,
            ]);
        } else {
            Teriff::create([
                'code' => $this->getCode(),
                'name' => $this->name,
                'contact_person' => Auth::user()?->id,
                'from' => $this->from,
                'to' => $this->to,
                'isneverexpired' => false,
            ]);
        }

        session()->flash('message', 'Teriff Created  Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function getCode()
    {
        $maxId = Teriff::max('id');
        return 'TR' . $maxId + 1;
    }

    public function edit(int $teriff_id)
    {
        $teriff = Teriff::find($teriff_id);
        if ($teriff) {
            $this->teriff_id = $teriff->id;
            $this->name = $teriff->name;
            $this->code = $teriff->code;
            $this->from = $teriff->from;
            $this->to = $teriff->to ?: null;
            $this->isneverexpired = $teriff->isneverexpired;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Teriff::where('id', $this->teriff_id)->update([
            'name' => $validatedData['name'],
            'from' => $validatedData['from'],
            'to' => $validatedData['to'] ?: null,
            'isneverexpired' => $this->isneverexpired ? true : false,
        ]);
        session()->flash('message', 'Teriff Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $teriff_id)
    {
        $this->teriff_id = $teriff_id;
    }

    public function destroy()
    {
        Teriff::find($this->teriff_id)->delete();
        session()->flash('message', 'Teriff deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $teriffs = Teriff::orderBy('id', 'DESC')->get();
        return view('livewire.service.teriff.teriff-master', ['teriffs' => $teriffs])->extends('layouts.admin')->section('content');
    }
}

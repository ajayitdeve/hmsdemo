<?php

namespace App\Http\Livewire\Master\Abnormal;

use App\Models\Abnormal;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class AbnormalMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $abnormal_id, $name, $code;

    public function mount() {}

    public function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('abnormals', 'name')->ignore($this->abnormal_id),
            ],
            'code' => [
                'required',
                Rule::unique('abnormals', 'code')->ignore($this->abnormal_id),
            ],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        $validatedData['created_by_id'] = auth()->user()?->id;
        Abnormal::create($validatedData);

        session()->flash('message', 'Abnormal Added Successfully.');
        $this->reset(['abnormal_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $abnormal_id)
    {
        $abnormal = Abnormal::find($abnormal_id);
        if ($abnormal) {
            $this->abnormal_id = $abnormal_id;
            $this->name = $abnormal->name;
            $this->code = $abnormal->code;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Abnormal::where('id', $this->abnormal_id)->update($validatedData);

        session()->flash('message', 'Abnormal Edited Successfully.');
        $this->reset(['abnormal_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $abnormal_id)
    {
        $this->abnormal_id = $abnormal_id;
    }

    public function destroy()
    {
        Abnormal::find($this->abnormal_id)->delete();

        session()->flash('message', 'Abnormal delete Successfully.');
        $this->reset(['abnormal_id', 'name', 'code']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset(['abnormal_id', 'name', 'code']);
    }

    public function render()
    {
        $abnormals = Abnormal::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.abnormal.abnormal-master', compact('abnormals'))->extends('layouts.admin')->section('content');
    }
}

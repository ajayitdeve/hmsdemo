<?php

namespace App\Http\Livewire\Master\AdminPurpose;

use App\Models\AdmissionPurpose;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class AdminPurposeMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $admission_purpose_id;


    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('admission_purposes')->ignore($this->admission_purpose_id),
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
        AdmissionPurpose::create($validatedData);

        session()->flash('message', 'Admission Purpose Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $admission_purpose_id)
    {
        $admin_purpose = AdmissionPurpose::find($admission_purpose_id);
        if ($admin_purpose) {
            $this->admission_purpose_id = $admission_purpose_id;
            $this->name = $admin_purpose->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        AdmissionPurpose::where('id', $this->admission_purpose_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Admission Purpose Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $admission_purpose_id)
    {
        $this->admission_purpose_id = $admission_purpose_id;
    }

    public function destroy()
    {
        AdmissionPurpose::find($this->admission_purpose_id)->delete();
        session()->flash('message', 'Admission purpose delete Successfully.');
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
    }

    public function render()
    {
        $admin_purposes = AdmissionPurpose::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.admin-purpose.admin-purpose-master', compact('admin_purposes'))->extends('layouts.admin')->section('content');
    }
}

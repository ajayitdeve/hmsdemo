<?php

namespace App\Http\Livewire\Master\CaseType;

use App\Models\CaseType;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class CaseTypeMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $case_type_id;


    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('case_types')->ignore($this->case_type_id),
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
        CaseType::create($validatedData);

        session()->flash('message', 'Case Type Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $case_type_id)
    {
        $case_type = CaseType::find($case_type_id);
        if ($case_type) {
            $this->case_type_id = $case_type_id;
            $this->name = $case_type->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        CaseType::where('id', $this->case_type_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Case Type Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $case_type_id)
    {
        $this->case_type_id = $case_type_id;
    }

    public function destroy()
    {
        CaseType::find($this->case_type_id)->delete();
        session()->flash('message', 'Case type delete Successfully.');
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
        $case_types = CaseType::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.master.case-type.case-type-master', compact('case_types'))->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Master\DischargeType;

use App\Models\DischargeType;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class DischargeTypeMaster extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $discharge_type_id, $name, $description;

    protected function rules()
    {
        return [
            'name' => [
                'required',
                Rule::unique('discharge_types')->ignore($this->discharge_type_id),
            ],
            'description' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        DischargeType::create($validatedData);

        session()->flash('message', 'Discharge Type Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $discharge_type_id)
    {
        $discharge_type = DischargeType::find($discharge_type_id);
        if ($discharge_type) {
            $this->discharge_type_id = $discharge_type_id;
            $this->name = $discharge_type->name;
            $this->description = $discharge_type->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        DischargeType::where('id', $this->discharge_type_id)->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description']
        ]);

        session()->flash('message', 'Discharge Type Updated Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $discharge_type_id)
    {
        $this->discharge_type_id = $discharge_type_id;
    }

    public function destroy()
    {
        DischargeType::find($this->discharge_type_id)->delete();
        session()->flash('message', 'Discharge type delete Successfully.');
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
        $this->description = '';
    }

    public function render()
    {
        $discharge_types = DischargeType::latest()->paginate(10);

        return view('livewire.master.discharge-type.discharge-type-master', compact('discharge_types'))->extends('layouts.admin')->section('content');
    }
}

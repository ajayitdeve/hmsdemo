<?php

namespace App\Http\Livewire\Pharmacy\Type;


use App\Models\CostCenter;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class TypeMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $type_id, $cost_center_id, $costcenters = [];

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->cost_center_id = CostCenter::first()?->id;
    }

    protected function rules()
    {
        return [
            'name' => 'required|unique:types',
            'cost_center_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        Type::create([
            'name' => $this->name,
            'cost_center_id' => $this->cost_center_id
        ]);

        session()->flash('message', 'Type Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $type_id)
    {
        $type = Type::find($type_id);
        if ($type) {
            $this->name = $type->name;
            $this->type_id = $type_id;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        Type::where('id', $this->type_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Type Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $type_id)
    {
        $this->type_id = $type_id;
    }

    public function destroy()
    {
        Type::find($this->type_id)->delete();

        session()->flash('message', 'Type  delete Successfully.');
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
        $types = Type::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.pharmacy.type.type-master', ['types' => $types])->extends('layouts.admin')->section('content');
    }
}

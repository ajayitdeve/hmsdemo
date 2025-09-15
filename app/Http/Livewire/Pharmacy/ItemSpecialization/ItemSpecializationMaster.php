<?php

namespace App\Http\Livewire\Pharmacy\ItemSpecialization;

use App\Models\CostCenter;
use App\Models\ItemSpecialization;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class ItemSpecializationMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $type_id = 1, $cost_center_id = 1, $item_specialization_id, $types = [], $costcenters = [];

    public function mount()
    {
        $this->costcenters = CostCenter::get();
        $this->types = Type::get();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'type_id' => 'required',
            'cost_center_id' => 'required'
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $validatedData = $this->validate();
        // dd($validatedData);
        ItemSpecialization::create($validatedData);

        session()->flash('message', 'Item Specialization Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $item_specialization_id)
    {
        $this->item_specialization_id = $item_specialization_id;
        $itemspecialization = ItemSpecialization::find($item_specialization_id);
        if ($itemspecialization) {
            $this->name = $itemspecialization->name;
            $this->type_id = $itemspecialization->type_id;
            $this->cost_center_id = $itemspecialization->cost_center_id;
        } else {
        }
    }

    public function update()
    {

        $validatedData = $this->validate();
        ItemSpecialization::where('id', $this->item_specialization_id)->update([
            'name' => $validatedData['name'],
            'type_id' => $validatedData['type_id'],
            'cost_center_id' => $validatedData['cost_center_id']
        ]);
        session()->flash('message', 'Item Specialization Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function delete(int $itemspecialization_id)
    {
        $this->itemspecialization_id = $itemspecialization_id;
    }

    public function destroy()
    {
        ItemSpecialization::find($this->itemspecialization_id)->delete();
        session()->flash('message', 'Item Specialization   delete Successfully.');
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
        $itemspecializations = ItemSpecialization::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.pharmacy.item-specialization.item-specialization-master', ['itemspecializations' => $itemspecializations])->extends('layouts.admin')->section('content');
    }
}

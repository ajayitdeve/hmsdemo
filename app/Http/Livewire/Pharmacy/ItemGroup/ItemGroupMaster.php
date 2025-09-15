<?php

namespace App\Http\Livewire\Pharmacy\ItemGroup;

use App\Models\CostCenter;
use App\Models\Item;
use App\Models\ItemGroup;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class ItemGroupMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $type_id = 1, $cost_center_id = 1, $item_group_id, $types = [], $costcenters = [];
    public $stock_point_id;

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
        ItemGroup::create($validatedData);

        session()->flash('message', 'Item Group Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $item_group_id)
    {
        $this->item_group_id = $item_group_id;
        $itemgroup = ItemGroup::find($item_group_id);
        if ($itemgroup) {
            $this->name = $itemgroup->name;
            $this->type_id = $itemgroup->type_id;
            $this->cost_center_id = $itemgroup->cost_center_id;
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        ItemGroup::where('id', $this->item_group_id)->update([
            'name' => $validatedData['name'],
            'type_id' => $validatedData['type_id'],

        ]);
        session()->flash('message', 'Item Group Edited Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $item_group_id)
    {
        $this->item_group_id = $item_group_id;
    }

    public function destroy()
    {
        ItemGroup::find($this->item_group_id)->delete();
        session()->flash('message', 'Item Group  delete Successfully.');
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
        $itemgroups = ItemGroup::orderBy('id', 'DESC')->paginate(10);

        return view('livewire.pharmacy.item-group.item-group-master', ['itemgroups' => $itemgroups])->extends('layouts.admin')->section('content');
    }
}

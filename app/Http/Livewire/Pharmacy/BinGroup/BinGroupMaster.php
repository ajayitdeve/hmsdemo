<?php

namespace App\Http\Livewire\Pharmacy\BinGroup;


use App\Models\Service\BillingHead;
use App\Models\StockPoint;
use Livewire\Component;
use App\Models\BinGroup;

class BinGroupMaster extends Component
{
    public $stock_point_id, $name;
    public $bin_group_id, $stockpoints = [];
    public function mount()
    {
        $this->stockpoints = StockPoint::get();
    }

    protected function rules()
    {
        return [
            'stock_point_id' => 'required',
            'name' => 'required',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        $validatedData = $this->validate();
        BinGroup::create([
            'stock_point_id' => $this->stock_point_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Bin Group Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $bin_group_id)
    {
        $binGroup = BinGroup::find($bin_group_id);
        $this->bin_group_id = $bin_group_id;
        //dd($binGroup);
        if ($binGroup) {
            $this->stock_point_id = $binGroup->stock_point_id;
            $this->name = $binGroup->name;
        } else {

        }

    }

    public function update()
    {
        $validatedData = $this->validate();
        BinGroup::where('id', $this->bin_group_id)->update([
            'name' => $validatedData['name'],
            'stock_point_id'=>$validatedData['stock_point_id']
        ]);
        session()->flash('message', 'Bin Group  Edited Successfully.');
        $this->resetExcept('stockpoints');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete(int $bin_group_id)
    {
        $this->bin_group_id = $bin_group_id;
    }

    public function destroy()
    {
        $binGroup = BinGroup::find($this->bin_group_id)->delete();
        session()->flash('message', 'Bin Group delete Successfully.');
        $this->resetExcept('stockpoints');
        $this->stockpoints = StockPoint::get();
        $this->dispatchBrowserEvent('close-modal');

    }

    public function render()
    {
        $bingroups = BinGroup::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.pharmacy.bin-group.bin-group-master', ['bingroups' => $bingroups])->extends('layouts.admin')->section('content');
    }

}

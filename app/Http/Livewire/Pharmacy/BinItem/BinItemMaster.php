<?php

namespace App\Http\Livewire\Pharmacy\BinItem;

use App\Models\Bin;
use App\Models\Item;
use App\Models\BinItem;
use Livewire\Component;
use App\Models\BinGroup;
use App\Models\StockPoint;

class BinItemMaster extends Component
{
    public $bin_group_id,$stock_point_id,$bin_id,$item_id;
    public $bin_item_id,$bingroups=[],$stockponts=[],$bins=[],$items=[];
    public function mount()
    {
        $this->stockpoints = StockPoint::get();
        $this->bingroups=BinGroup::get();
        $this->bins=BinGroup::get();
        $this->items=Item::get();
    }

    protected function rules()
    {
        return [
            'stock_point_id' => 'required',
            'bin_group_id' => 'required',
            'bin_id'=>'required',
            'item_id'=>'required',

        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save()
    {
        //$bin_group_id,$stock_point_id,$bin_id,$item_id;
        $validatedData = $this->validate();
        BinItem::create([
            'stock_point_id' => $this->stock_point_id,
            'bin_group_id' => $this->bin_group_id,
            'bin_id'=> $this->bin_id,
            'item_id'=>$this->item_id
        ]);

        session()->flash('message', 'Bin Assigned To ItemSuccessfully.');
        $this->resetExcept('bins','bingroups','stockpoints','items');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $bin_item_id)
    {
        $binItem = BinItem::find($bin_item_id);
        $this->bin_item_id = $bin_item_id;
        //dd($binGroup);

        if ($binItem) {
            $this->stock_point_id = $binItem->stock_point_id;
            $this->bin_group_id = $binItem->bin_group_id;
            $this->bin_id = $binItem->bin_id;
            $this->item_id = $binItem->item_id;
        } else {

        }

    }

    public function update()
    {
        $validatedData = $this->validate();
        //dd($validatedData);
        BinItem::where('id', $this->bin_item_id)->update(
            [

                'stock_point_id'=>$validatedData['stock_point_id'],
                'bin_group_id'=>$validatedData['bin_group_id'],
                'bin_id'=>$validatedData['bin_group_id'],
                'item_id'=>$validatedData['item_id']
            ]
        );
        session()->flash('message', 'Bin Item  Edited Successfully.');
        $this->resetExcept('bins','bingroups','stockpoints','items');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete(int $bin_item_id)
    {
        $this->bin_item_id = $bin_item_id;
    }

    public function destroy()
    {
        $binItem = BinItem::find($this->bin_item_id)->delete();
        session()->flash('message', 'Bin Item delete Successfully.');
        $this->resetExcept('bins','bingroups','stockpoints','items');
        $this->stockpoints = StockPoint::get();
        $this->bingroups = BinGroup::get();
        $this->items = Item::get();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function stockPointChanged(){
        $this->bingroups=BinGroup::where('stock_point_id',$this->stock_point_id)->get();
    }

    public function binGroupChanged(){
        $this->bins=Bin::where('bin_group_id',$this->bin_group_id)->get();
    }
    public function render()
    {
        $binitems = BinItem::orderBy('id', 'DESC')->get();
        return view('livewire.pharmacy.bin-item.bin-item-master', ['binitems' => $binitems])->extends('layouts.admin')->section('content');
    }


}

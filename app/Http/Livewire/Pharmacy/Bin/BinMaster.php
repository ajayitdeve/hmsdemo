<?php

namespace App\Http\Livewire\Pharmacy\Bin;

use App\Models\Bin;
use Livewire\Component;
use App\Models\BinGroup;
use App\Models\StockPoint;

class BinMaster extends Component
{
    public $bin_group_id, $stock_point_id,$name;
    public $bin_id,$bingroups=[],$stockponts=[];
    public function mount()
    {
        $this->stockpoints = StockPoint::get();
        $this->bingroups=BinGroup::get();
    }

    protected function rules()
    {
        return [
            'stock_point_id' => 'required',
            'bin_group_id' => 'required',
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
        Bin::create([
            'stock_point_id' => $this->stock_point_id,
            'bin_group_id' => $this->bin_group_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'Bin Added Successfully.');
        $this->resetExcept('bingroups','stockpoints');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function edit(int $bin_id)
    {

        $bin = Bin::find($bin_id);
        $this->bin_id = $bin_id;
        //dd($binGroup);
        if ($bin) {
            $this->stock_point_id = $bin->stock_point_id;
            $this->bin_group_id = $bin->bin_group_id;
            $this->name = $bin->name;
        } else {

        }

    }

    public function update()
    {
        $validatedData = $this->validate();
        //dd($validatedData);
        Bin::where('id', $this->bin_id)->update(
            [
                'name' => $validatedData['name'],
                'stock_point_id'=>$validatedData['stock_point_id'],
                'bin_group_id'=>$validatedData['bin_group_id']
            ]
        );
        session()->flash('message', 'Bin  Edited Successfully.');
        $this->resetExcept('stockpoints','bingroups');
        $this->dispatchBrowserEvent('close-modal');

    }


    public function delete(int $bin_id)
    {
        $this->bin_id = $bin_id;
    }

    public function destroy()
    {
        $bin = Bin::find($this->bin_id)->delete();
        session()->flash('message', 'Bin delete Successfully.');
        $this->resetExcept('stockpoints','bingroups');
        $this->stockpoints = StockPoint::get();
        $this->bingroups = BinGroup::get();
        $this->dispatchBrowserEvent('close-modal');

    }


    public function stockPointChanged(){
        $this->bingroups=BinGroup::where('stock_point_id',$this->stock_point_id)->get();
    }

    public function render()
    {
        $bins = Bin::orderBy('id', 'DESC')->paginate(10);
        return view('livewire.pharmacy.bin.bin-master', ['bins' => $bins])->extends('layouts.admin')->section('content');
    }


}

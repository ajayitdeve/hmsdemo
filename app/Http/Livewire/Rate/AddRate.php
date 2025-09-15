<?php

namespace App\Http\Livewire\Rate;

use Livewire\Component;
use Auth;

class AddRate extends Component
{
    public $item_id,$batch_no,$current_purchase_rate,$current_sale_rate,$new_purchase_rate,$new_sale_rate,$doc,$status,$approved_by_id,$remarks;
    public $rates=[],$items=[],$hidForm=true;

    public function mount(){
    $this->items=\App\Models\Item::get();
    $this->hideForm=true;
    }
    public function itemChanged(){
        if($this->item_id!=-1){
            $this->rates=\App\Models\Rate::where('item_id',$this->item_id)->get();
            $this->hideForm=false;
        }else{
            $this->hideForm=true;
        }
    }


   protected function rules(){
        return [
            'batch_no'=>'required',
            'new_purchase_rate'=>'required',
            'new_sale_rate'=>'required'
            ];
    }
    public function save(){
      
        $validatedData=$this->validate();

        \App\Models\Rate::create([
            'item_id'=>$this->item_id,
            'batch_no'=>$this->batch_no,
            'current_purchase_rate'=>0.0,
            'current_sale_rate'=>0.0,
            'new_purchase_rate'=>$this->new_purchase_rate,
            'new_sale_rate'=>$this->new_sale_rate,
            'doc'=>\Carbon\Carbon::now(),
            'status'=>1,
            'approved_by_id'=>Auth::id(),
            'remarks'=>'New Entry'

            ]);
         
            session()->flash('message', 'Rate Added Successfully.');
            $this->reset(['item_id', 'batch_no', 'current_purchase_rate', 'current_sale_rate', 'new_purchase_rate', 'new_sale_rate', 'doc', 'status', 'approved_by_id', 'remarks']);
                 
    }
    public function render()
    {
        $rates=\App\Models\Rate::all();
        return view('livewire.rate.add-rate')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;

class PrintPo extends Component
{
    public  $purchase_order_id;
    public function mount($purchase_order_id){
        $this->purchase_order_id = $purchase_order_id;
    }
    public function render()
    {
        $purchaseOrder=\App\Models\PurchaseOrder::find($this->purchase_order_id);   
        return view('livewire.po.print-po',['purchaseOrder'=>$purchaseOrder])->extends('layouts.admin')->section('content');;
    }
}

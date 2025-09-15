<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;

class ShowPurchaseIndent extends Component
{
    public $purchase_indent_id;
    public function mount($purchase_indent_id){
        $this->purchase_indent_id = $purchase_indent_id;
    }
    public function render()
    {
        $purchaseIndent=\App\Models\PurchaseIndent::find($this->purchase_indent_id);
        return view('livewire.po.show-purchase-indent',['purchaseIndent'=>$purchaseIndent])->extends('layouts.admin')->section('content');;
    
    }
}

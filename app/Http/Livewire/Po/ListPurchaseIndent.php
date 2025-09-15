<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;

class ListPurchaseIndent extends Component
{
    public $recentIndents=[];
    public function mount(){
        $this->recentIndents= \App\Models\PurchaseIndent::orderBy('id','DESC')->get(); 
    }
    public function render()
    {

        return view('livewire.po.list-purchase-indent')->extends('layouts.admin')->section('content');;
    }
}

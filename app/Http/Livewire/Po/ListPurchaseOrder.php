<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ListPurchaseOrder extends Component
{
    public $purchaseOrders = [], $currentRole;

    public function mount()
    {
        $this->purchaseOrders = \App\Models\PurchaseOrder::orderBy('id', 'DESC')->get();
        $this->currentRole = Auth::user()->roles->pluck('name')[0] ?? null;
        // dd($this->purchaseOrders);
    }
    public function approve(int $id)
    {
        $purchaseOrder = \App\Models\PurchaseOrder::find($id);
        $purchaseOrder->status = 1;
        $purchaseOrder->save();
        //session()->flash('message', 'PO Approved successfully.');
        return redirect()->route('admin.po.list-purchase-order')->with('message', 'PO Approved successfully.');
    }
    public function render()
    {
        return view('livewire.po.list-purchase-order')->extends('layouts.admin')->section('content');;
    }
}

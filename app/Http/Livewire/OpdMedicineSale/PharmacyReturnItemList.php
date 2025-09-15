<?php

namespace App\Http\Livewire\OpdMedicineSale;

use Livewire\Component;
use App\Models\Pharmacy\PharmacyReturn;
use App\Models\Pharmacy\PharmacyReturnItem;

class PharmacyReturnItemList extends Component
{
    public $pharmacyReturnItems = [];
    public function mount($id)
    {
        $pharmacyReturn = PharmacyReturn::find($id);
        $this->pharmacyReturnItems = $pharmacyReturn->pharmacyReturnItems;
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.pharmacy-return-item-list')->extends('layouts.admin')->section('content');
    }
}

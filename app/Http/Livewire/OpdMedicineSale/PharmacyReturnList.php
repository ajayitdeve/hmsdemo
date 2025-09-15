<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\Pharmacy\PharmacyReturn;
use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class PharmacyReturnList extends Component
{
    use PharmacyStockPoint;

    public $stock_point_id, $stockPoint, $pharmacyReturns = [];
    public function mount()
    {
        $this->checkStockPointSession();

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));

        $this->stockPoint = $stockPoint;
        $this->stock_point_id = $stockPoint->id;
        $this->pharmacyReturns = PharmacyReturn::where('stock_point_id', $this->stock_point_id)->latest()->get();
    }

    public function render()
    {
        return view('livewire.opd-medicine-sale.pharmacy-return-list')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\SaleStore;

use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class ListSaleStoreByStockPoint extends Component
{
    use PharmacyStockPoint;

    public function mount()
    {
        $this->checkStockPointSession();
    }

    public function render()
    {

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));

        $saleStores = \App\Models\SaleStore::when($stockPoint, function ($query) use ($stockPoint) {
            return $query->where('stock_point_id', $stockPoint?->id);
        })
            ->where('received', 1)
            ->orderBy('id', "DESC")
            ->get();

        return view('livewire.sale-store.list-sale-store-by-stock-point', ['saleStores' => $saleStores])->extends('layouts.admin')->section('content');
    }
}

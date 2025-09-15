<?php

namespace App\Http\Livewire\SaleStore;

use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class NewGin extends Component
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
            ->where('received', 0)
            ->orderBy('id', "DESC")
            ->get();

        return view('livewire.sale-store.new-gin', ['saleStores' => $saleStores])->extends('layouts.admin')->section('content');
    }

    public function changeStatus(int $sale_store_id)
    {
        $saleStore = \App\Models\SaleStore::find($sale_store_id);
        $saleStore->received = !$saleStore->received;
        $saleStore->update();
        session()->flash('message', 'Status Updated Successfully.');
    }
}

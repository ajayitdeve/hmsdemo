<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\OpdMedicineReceipt;
use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class PharmacyCancleReceipt extends Component
{
    use PharmacyStockPoint;

    public $opdMedicineReceipts = [], $stock_point_id;
    public function mount()
    {
        $this->checkStockPointSession();

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stock_point_id = $stockPoint?->id;

        $this->opdMedicineReceipts = OpdMedicineReceipt::when($this->stock_point_id, function ($query) {
            return $query->where('stock_point_id', $this->stock_point_id);
        })->where('is_cancled', 1)->get();
    }

    public function render()
    {
        return view('livewire.opd-medicine-sale.pharmacy-cancle-receipt')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Pharmacy\Issues\IpPharmacyBilling;

use App\Models\IpPharmacyIndentBilling;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class IpPharmacyBilling extends Component
{
    use PharmacyStockPoint;
    public $ipd;
    protected $queryString = ['ipd'];

    public $stock_point_id, $stock_point;
    public $ip_pharmacy_bills = [];

    public function mount()
    {
        $this->checkStockPointSession();

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stock_point = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;

        $this->ip_pharmacy_bills = IpPharmacyIndentBilling::when($this->stock_point_id, function ($query) {
            return $query->where('stock_point_id', $this->stock_point_id);
        })
            ->when($this->ipd, function ($query) {
                $query->whereHas('ipd', function ($subQuery) {
                    $subQuery->where('ipdcode', $this->ipd);
                });
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.pharmacy.issues.ip-pharmacy-billing.ip-pharmacy-billing')->extends('layouts.admin')->section('content');
    }
}

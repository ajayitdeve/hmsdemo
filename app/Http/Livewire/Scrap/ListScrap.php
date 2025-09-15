<?php

namespace App\Http\Livewire\Scrap;

use App\Models\Scrap;
use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class ListScrap extends Component
{
    use PharmacyStockPoint;

    public $stock_point_id, $scraps;
    public function mount()
    {
        $this->checkStockPointSession();

        //geting stockpoint for currently loggedin user
        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stockPoint = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;

        //getting scraps for stockpoints
        $this->scraps = Scrap::when($this->stock_point_id, function ($query) {
            return $query->where('stock_point_from_id', $this->stock_point_id);
        })->orderBy('id', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.scrap.list-scrap')->extends('layouts.admin')->section('content');
    }
}

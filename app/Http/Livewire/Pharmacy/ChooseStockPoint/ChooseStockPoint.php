<?php

namespace App\Http\Livewire\Pharmacy\ChooseStockPoint;

use App\Models\StockPoint;
use Livewire\Component;

class ChooseStockPoint extends Component
{
    public $stock_point;
    public $stock_points = [];

    public function rules()
    {
        return [
            'stock_point' => 'required',
        ];
    }

    public function mount()
    {
        $this->stock_points = StockPoint::whereIn("id", auth()->user()?->team?->stock_point?->stock_points)->get();

        if (session()->has("stock_point_id")) {
            $this->stock_point = session()->get("stock_point_id");
        }
    }

    public function save()
    {
        $this->validate();

        session(['stock_point_id' => $this->stock_point]);

        return redirect()->route('admin.dashboard');
    }
    public function render()
    {
        return view('livewire.pharmacy.choose-stock-point.choose-stock-point')->extends('layouts.admin')->section('content');
    }
}

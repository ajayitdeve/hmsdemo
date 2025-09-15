<?php

namespace App\Traits;

trait PharmacyStockPoint
{
    public function checkStockPointSession()
    {
        if (!session()->has("stock_point_id")) {
            return redirect()->route("admin.stock-point")->with("error", "Please select a stock point first");
        }
    }
}

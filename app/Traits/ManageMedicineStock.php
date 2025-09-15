<?php

namespace App\Traits;

use App\Models\IpPharmacyIndentItem;
use App\Models\OpdMedicineTransaction;
use App\Models\SaleStore;
use App\Models\ScrapItem;

trait ManageMedicineStock
{
    public function availableQuantityByItem($item_id)
    {
        $batchNos = SaleStore::select('batch_no')->where('stock_point_id', $this->stock_point_id)->where('item_id', $item_id)->where('received', 1)->distinct()->pluck('batch_no');
        $arrQtyByBatch = [];
        foreach ($batchNos as $batchNo) {
            $temp = [];
            $temp['batch_no'] = $batchNo;
            $total_quantity = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item_id)->where('batch_no', $batchNo)->sum('quantity');

            $sale_qty_1 = OpdMedicineTransaction::where('item_id', $item_id)->where('batch_no', $batchNo)->sum('quantity');
            $sale_qty_2 = IpPharmacyIndentItem::where('item_id', $item_id)->where('batch_no', $batchNo)->sum('quantity');
            $sale_qty_3 = ScrapItem::where('item_id', $item_id)->where('batch_no', $batchNo)->sum('quantity');

            $total_stock = $total_quantity - ($sale_qty_1 + $sale_qty_2 + $sale_qty_3);

            if ($total_stock > 0) {
                $temp['quantity'] = $total_stock;
                array_push($arrQtyByBatch, $temp);
            }
        }

        return $arrQtyByBatch;
    }

    public function check_available_stock()
    {
        $total_quantity = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('quantity');

        $sale_qty_1 = OpdMedicineTransaction::where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('quantity');
        $sale_qty_2 = IpPharmacyIndentItem::where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('quantity');
        $sale_qty_3 = ScrapItem::where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('quantity');


        // Quantity already added in cart
        $cart_qty = 0;
        foreach ($this->arrCart as $cartItem) {
            if ($cartItem['item_id'] == $this->item_id && $cartItem['batch_no'] == $this->batch_no) {
                $cart_qty += $cartItem['quantity'];
            }
        }

        // Final available stock
        $total_stock = $total_quantity - ($sale_qty_1 + $sale_qty_2 + $sale_qty_3 + $cart_qty);

        if ($total_stock < $this->quantity) {
            return true;
        }

        return false;
    }
}

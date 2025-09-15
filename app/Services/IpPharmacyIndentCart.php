<?php

namespace App\Services;

class IpPharmacyIndentCart
{
    public $id, $item_id, $item_name, $stock_point_id, $batch_no, $exd, $quantity, $unit_sale_price, $amount, $discount, $taxable_amount, $cgst, $sgst, $total, $discount_approved_by_id;

    function __construct($id, $item_id, $item_name, $stock_point_id, $batch_no, $exd, $quantity, $unit_sale_price, $amount, $discount, $taxable_amount, $cgst, $sgst, $total, $discount_approved_by_id = null)
    {
        $this->id = $id;
        $this->item_id = $item_id;
        $this->item_name = $item_name;
        $this->stock_point_id = $stock_point_id;
        $this->batch_no = $batch_no;
        $this->exd = $exd;
        $this->quantity = $quantity;
        $this->unit_sale_price = $unit_sale_price;
        $this->amount = $amount;
        $this->discount = $discount;
        $this->taxable_amount = $taxable_amount;
        $this->cgst = $cgst;
        $this->sgst = $sgst;
        $this->total = $total;
        $this->discount_approved_by_id = $discount_approved_by_id;
    }
}

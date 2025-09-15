<?php

namespace App\Models;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpdMedicineTransaction extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['opd_medicine_receipt_id', 'item_id', 'stock_point_id','batch_no', 'quantity', 'unit_sale_price', 'amount', 'discount', 'taxable_amount', 'cgst', 'sgst', 'total','$discount_approved_by_id','is_cancled'];
public function item(){
    return $this->belongsTo(Item::class,'item_id');
}
public function stockpoint(){
    return $this->belongsTo(StockPoint::class,'stock_point_id');
}

public function opdmedicinereceipt(){
    return $this->belongsTo(OpdMedicineReceipt::class,'opd_medicine_receipt_id');
}

}

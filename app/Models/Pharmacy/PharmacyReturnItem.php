<?php

namespace App\Models\Pharmacy;

use App\Models\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PharmacyReturnItem extends Model
{
    use HasFactory;
    protected $fillable = ['opd_medicine_receipt_id','pharmacy_return_id','item_id','stock_point_id','batch_no','exd','quantity','unit_sale_price','amount','discount','taxable_amount','cgst','sgst','total','created_by_id','approved_by_id'];
    public function pharmacyReturn(){
        return $this->belongsTo(PharmacyReturn::class,'pharmacy_return_id','id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id','id');
    }


}

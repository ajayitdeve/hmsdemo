<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapItem extends Model
{
    use HasFactory;

    protected $fillable = ['scrap_id','item_id','grn_id','scrap_type_id','batch_no','quantity','unit_sale_price','unit_purchase_price','remarks','created_by_id','updated_by_id'] ;
    public function scrap(){
        return $this->belongsTo(ScrapItem::class,'scrap_id','id');
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class MrqItem extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['mrq_id', 'item_id', 'quantity','approved_quantity'];
    public function mrq(){
        return $this->belongsTo(Mrq::class);
    }
    public function item(){
        return $this->belongsTo(Item::class,'item_id');
    }
}

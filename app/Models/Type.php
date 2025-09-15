<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Type extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name','cost_center_id'];

    public function costcenter(){
        return $this->belongsTo(\App\Models\CostCenter::class,'cost_center_id');
    }
    
}

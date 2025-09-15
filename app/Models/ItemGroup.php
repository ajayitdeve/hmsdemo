<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ItemGroup extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','cost_center_id','type_id'];
    public function type(){
        return $this->belongsTo(\App\Models\Type::class,'type_id');
    }
    public function costcenter(){
        return $this->belongsTo(\App\Models\CostCenter::class,'cost_center_id');
    }
    
}

<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WardGroup extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','code','status','ward_tariff_id','created_by_id','updated_by_id'];
    public function wardTariff(){
        return $this->belongsTo(WardTariff::class);
    }
    public function createdById(){
        return $this->belongsTo(User::class,'created_by_id','id');
    }

    public function updatedById(){
        return $this->belongsTo(User::class,'updated_by_id','id');
     }
}

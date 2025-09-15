<?php

namespace App\Models\Ipd;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WardTariff extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['name','code','created_by_id','updated_by_id'];

    public function createdById(){
        return $this->belongsTo(User::class,'created_by_id','id');
    }

    public function updatedById(){
        return $this->belongsTo(User::class,'updated_by_id','id');
     }
}

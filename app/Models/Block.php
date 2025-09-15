<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Block extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','country_id','state_id','district_id'];
    public function country(){
        return $this->belongsTo(\App\Models\Country::class);
    }
    public function state(){
        return $this->belongsTo(\App\Models\State::class);
    }

    public function district(){
        return $this->belongsTo(\App\Models\District::class);
    }

    
    public function villages(){
        return $this->hasMany(Village::class);
    }


}

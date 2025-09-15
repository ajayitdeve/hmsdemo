<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class State extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','country_id'];
    public function country(){
        return $this->belongsTo(\App\Models\Country::class);
    }
    public function districts(){
        return $this->hasMany(District::class);
    }

    public function blocks(){
        return $this->hasMany(Block::class);
    }

    public function villages(){
        return $this->hasMany(Village::class);
    }
  

}

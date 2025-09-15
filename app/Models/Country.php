<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Country extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name'];

    public function states(){
        return $this->hasMany(State::class);
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Referral extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];

    public function referrable(){
        return $this->morphTo();
    }

    public function patient(){
        return $this->belongsTo(Patient::class,'patient_id');
    }
}

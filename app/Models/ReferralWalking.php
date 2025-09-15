<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralWalking extends Model
{
    use HasFactory;
    protected $fillable=['name'];
    public function referral(){
        return $this->morphOne(Referral::class,'referrable');
    }
}

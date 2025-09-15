<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Staff extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['name','father_name','mobile','department_id'];
    public function referral(){
        return $this->morphOne(Referral::class,'referrable');
    }
}

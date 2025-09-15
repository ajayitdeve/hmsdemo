<?php

namespace App\Models\Ipd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class CorporateRelation extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['name'];
}

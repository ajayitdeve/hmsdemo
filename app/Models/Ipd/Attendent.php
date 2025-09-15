<?php

namespace App\Models\Ipd;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Attendent extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['ipd_id', 'relation_id', 'name', 'mobile', 'alt_mobile', 'address'];
}

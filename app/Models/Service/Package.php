<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Package extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['package_id', 'service_id', 'created_by_id', 'updated_by_id'];
}

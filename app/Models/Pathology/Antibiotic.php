<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Antibiotic extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=[ 'code', 'name', 'description', 'senstive', 'moderate', 'resistance', 'is_active', 'created_by_id', 'updated_by_id'];
}

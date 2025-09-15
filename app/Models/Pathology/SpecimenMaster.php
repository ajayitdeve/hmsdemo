<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SpecimenMaster extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['code', 'name', 's1_cd', 's2_cd', 'is_active', 'created_by_id', 'updated_by_id'];
}

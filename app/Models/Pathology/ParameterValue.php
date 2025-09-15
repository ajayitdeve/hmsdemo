<?php

namespace App\Models\Pathology;

use App\Models\Uom;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ParameterValue extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable=['parameter_id', 'parameter_unit_id', 'symbol_id', 'gender', 'min_age', 'min_age_uom', 'max_age', 'max_age_uom', 'min_range', 'max_range', 'normal_range', 'min_critical', 'max_critical','description' ];
public function parameter(){
    return $this->belongsTo(Parameter::class);
}
public function parameterUnit(){
    return $this->belongsTo(ParameterUnit::class);
}
public function symbol(){
    return $this->belongsTo(Symbol::class);
}
}

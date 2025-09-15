<?php

namespace App\Models\Pathology;

use App\Models\Department;
use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parameter extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['department_id', 'service_group_id', 'code', 'name', 'short_name', 'method', 'display_type', 'text_size', 'normal_range', 'antibiotic_needed', 'is_active', 'uom_unit', 'parameter_unit_id', 'multiple_values', 'multiple_value_json', 'created_by_id', 'updated_by_id'];
    public function parameterValue()
    {
        return $this->hasOne(ParameterValue::class);
    }
    public function parameterValues()
    {
        return $this->hasMany(ParameterValue::class);
    }
    public function serviceGroup()
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}

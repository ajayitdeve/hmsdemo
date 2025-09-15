<?php

namespace App\Models\Pathology;

use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Format extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['department_id', 'service_group_id', 'service_id', 'gender_id', 'doctor_id', 'lab_equivalent_name', 'report_title', 'code', 'name', 'method', 'is_gender_specific', 'is_sample_needed', 'is_default_format', 'is_growth', 'specimen', 'column_cap_1', 'column_cap_2', 'column_cap_3', 'column_cap_4', 'is_accrediation_needed', 'is_multiple_oranism_needed', 'is_clinical_history', 'is_no_normal_range', 'min_time', 'time_ins_min', 'max_time', 'time_ins_max', 'is_active', 'created_by_id', 'updated_by_id'];
    public function service(){
        return $this->belongsTo(Service::class);
    }

    public function formatParameters(){
        return $this->hasMany(FormatParameter::class);
    }

    public function serviceGroup(){
        return $this->belongsTo(ServiceGroup::class);
    }
    public function department(){
        return $this->belongsTo(Department::class);
    }




}

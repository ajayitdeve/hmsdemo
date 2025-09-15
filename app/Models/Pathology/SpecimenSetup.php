<?php

namespace App\Models\Pathology;

use App\Models\Department;
use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class SpecimenSetup extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [ 'code', 'department_id', 'service_group_id', 'service_id', 'specimen_master_id', 'vacutainer_id', 'test_type_id', 'color_id', 'duration', 'dosage_qty','no_of_barcode', 'short_name', 'precaution', 'clinical_history','is_applicable_for_others_test', 'is_required_precaution_on_bill', 'is_infection_dieases','is_curable', 's1_cd', 's2_cd', 'is_active', 'created_by_id', 'updated_by_id'] ;
    public function service(){
        return $this->belongsTo(SpecimenSetup::class,'service_id');
    }
    public function specimenMaster(){
        return $this->belongsTo(SpecimenMaster::class,'specimen_master_id');
    }
    public function vacutainer(){
        return $this->belongsTo(Vacutainer::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }
    public function serviceGroup(){
        return $this->belongsTo(ServiceGroup::class);
    }

    public function testType(){
        return $this->belongsTo(TestType::class);
    }

}

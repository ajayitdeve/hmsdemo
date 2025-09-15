<?php

namespace App\Models\Ipd;

use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Patient;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CorporateRegistration extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function corporate_relation()
    {
        return $this->belongsTo(CorporateRelation::class, 'corporate_relation_id', 'id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id', 'id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }

    public function cost_center()
    {
        return $this->belongsTo(CostCenter::class);
    }

    public function corporate_consultation()
    {
        return $this->hasOne(CorporateConsultation::class, 'corporate_registration_id', 'id');
    }

    public function ipd()
    {
        return $this->hasOne(Ipd::class, 'corporate_registration_id', 'id');
    }
}

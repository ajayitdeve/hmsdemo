<?php

namespace App\Models\Pathology;

use App\Models\Department;
use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organism extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['department_id', 'service_group_id', 'code', 'name', 'default_organism', 'is_active', 'created_by_id', 'updated_by_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function serviceGroup()
    {
        return $this->belongsTo(ServiceGroup::class);
    }
    public function antibiotics()
    {
        return $this->hasMany(AntibioticOrganism::class);
    }
}

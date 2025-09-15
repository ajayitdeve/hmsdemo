<?php

namespace App\Models\Pathology;

use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['code', 'department_id', 'service_group_id', 'service_id', 'format_id', 's1_cd', 's2_cd', 'is_active', 'created_by_id', 'updated_by_id'];

    public function format()
    {
        return $this->belongsTo(Format::class);
    }
    public function ServiceGroup()
    {
        return $this->belongsTo(ServiceGroup::class);
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

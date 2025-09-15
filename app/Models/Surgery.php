<?php

namespace App\Models;

use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use App\Models\Service\Teriff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Surgery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function tariff()
    {
        return $this->belongsTo(Teriff::class, "teriff_id");
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function service_group()
    {
        return $this->belongsTo(ServiceGroup::class);
    }

    public function surgery_type()
    {
        return $this->belongsTo(SurgeryType::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpdEquipmentUsageItem extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function equipment_group()
    {
        return $this->belongsTo(EquipmentGroup::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
}

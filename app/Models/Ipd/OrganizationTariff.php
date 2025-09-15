<?php

namespace App\Models\Ipd;

use App\Models\OrganizationTariffPriority;
use App\Models\Service\Teriff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTariff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function teriff_priority()
    {
        return $this->hasMany(OrganizationTariffPriority::class);
    }
}

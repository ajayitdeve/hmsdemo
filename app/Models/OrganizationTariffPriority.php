<?php

namespace App\Models;

use App\Models\Ipd\Organization;
use App\Models\Service\Teriff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationTariffPriority extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function teriff()
    {
        return $this->belongsTo(Teriff::class);
    }
}

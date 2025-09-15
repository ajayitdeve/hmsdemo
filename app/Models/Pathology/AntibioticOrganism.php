<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntibioticOrganism extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['organism_id', 'antibiotic_id'];

    public function antibiotic()
    {
        return $this->belongsTo(Antibiotic::class);
    }
}

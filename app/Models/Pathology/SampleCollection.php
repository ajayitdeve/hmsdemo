<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SampleCollection extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['opd_billing_id', 'code', 'lab_no', 'sample_entry_date', 'created_by_id', 'updated_by_id', 'approved_by_id'];

    public function sampleCollectionItems()
    {
        return $this->hasMany(SampleCollectionItem::class);
    }
}

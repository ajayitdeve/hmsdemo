<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IpdSampleCollection extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sample_collection_items()
    {
        return $this->hasMany(IpdSampleCollectionItem::class);
    }
}

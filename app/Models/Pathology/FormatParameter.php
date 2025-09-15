<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class FormatParameter extends Model
{
    use HasFactory,SoftDeletes;
    // `format_id`, `parameter_id`, `sub_title`, `sequence`
    public function parameter(){
        return $this->belongsTo(Parameter::class);
    }
}

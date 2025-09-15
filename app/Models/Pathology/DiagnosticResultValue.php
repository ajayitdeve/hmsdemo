<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiagnosticResultValue extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['diagnostic_result_id', 'parameter_id', 'service_id', 'result_value'];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function diagnosticResult()
    {
        return $this->belongsTo(DiagnosticResult::class, 'diagnostic_result_id', 'id');
    }
    public function service()
    {
        return $this->belongsTo(\App\Models\Service\Service::class);
    }
}

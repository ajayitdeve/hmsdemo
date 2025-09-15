<?php

namespace App\Models\Pathology;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpdDiagnosticResultValue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function parameter()
    {
        return $this->belongsTo(Parameter::class);
    }

    public function diagnosticResult()
    {
        return $this->belongsTo(IpdDiagnosticResult::class, 'ipd_diagnostic_result_id', 'id');
    }

    public function service()
    {
        return $this->belongsTo(\App\Models\Service\Service::class);
    }
}

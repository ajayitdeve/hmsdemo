<?php

namespace App\Http\Livewire\Pathology\DiagnosticResult;

use App\Models\Pathology\IpdDiagnosticResult;
use Livewire\Component;

class AllIpdDiagnosticResult extends Component
{
    public $diagnosticResults = [];

    public function mount()
    {
        $this->diagnosticResults = IpdDiagnosticResult::orderBy("created_at", "desc")->get();
    }

    public function render()
    {
        return view('livewire.pathology.diagnostic-result.all-ipd-diagnostic-result')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Pathology\DiagnosticResult;

use App\Models\Pathology\DiagnosticResult;
use Livewire\Component;

class AllDiagnosticResult extends Component
{
    public $diagnosticResults = [];

    public function mount()
    {
        $this->diagnosticResults = DiagnosticResult::orderBy("created_at", "desc")->get();
    }

    public function render()
    {
        return view('livewire.pathology.diagnostic-result.all-diagnostic-result')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Patient;

use Livewire\Component;
use App\Models\PatientVisit;

class NewConsultationList extends Component
{

    public $patientvisits = [];
    public function mount()
    {
        $this->patientvisits = PatientVisit::where('visit_type', 1)->where('visit_type_id', '!=', 3)->orderBy('id', 'desc')->get();
    }
    public function render()
    {
        return view('livewire.patient.new-consultation-list')->extends('layouts.admin')->section('content');
    }
}

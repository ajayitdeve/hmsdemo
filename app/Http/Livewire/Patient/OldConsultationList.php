<?php

namespace App\Http\Livewire\Patient;

use App\Models\PatientVisit;
use Livewire\Component;

class OldConsultationList extends Component
{

    public $patientvisits=[];
    public function mount(){
        $this->patientvisits=PatientVisit::where('visit_type_id',3)->orderBy('id','desc')->get();


    }
    public function render()
    {
        return view('livewire.patient.old-consultation-list')->extends('layouts.admin')->section('content');
    }
}

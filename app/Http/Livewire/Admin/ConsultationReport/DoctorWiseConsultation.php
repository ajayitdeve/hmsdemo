<?php

namespace App\Http\Livewire\Admin\ConsultationReport;

use App\Models\Doctor;
use Livewire\Component;
use App\Models\PatientVisit;

class DoctorWiseConsultation extends Component
{

  public $doctor_id,$patientvisits=[],$doctor;
  public function mount($doctor_id)  {
    $this->doctor=Doctor::find($doctor_id);
    if($this->doctor){
        $this->doctor_id = $doctor_id;
        $this->patientvisits=PatientVisit::where('doctor_id', $doctor_id)->get();
    }

  }
    public function render()
    {
        return view('livewire.admin.consultation-report.doctor-wise-consultation')->extends('layouts.admin')->section('content');
    }
}

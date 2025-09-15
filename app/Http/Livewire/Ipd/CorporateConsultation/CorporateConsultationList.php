<?php

namespace App\Http\Livewire\Ipd\CorporateConsultation;

use App\Models\Ipd\CorporateConsultation as IpdCorporateConsultation;
use Livewire\Component;

class CorporateConsultationList extends Component
{
    public $corporate_consultation_list;

    public function mount()
    {
        $this->corporate_consultation_list = IpdCorporateConsultation::latest()->get();
    }

    public function render()
    {
        return view('livewire.ipd.corporate-consultation.corporate-consultation-list')->extends('layouts.admin')->section('content');
    }
}

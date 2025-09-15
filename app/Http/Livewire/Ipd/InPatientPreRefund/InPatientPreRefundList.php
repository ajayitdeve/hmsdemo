<?php

namespace App\Http\Livewire\Ipd\InPatientPreRefund;

use App\Models\IpPreRefund;
use Livewire\Component;

class InPatientPreRefundList extends Component
{
    public $in_patient_pre_refunds = [];

    public function mount()
    {
        $this->in_patient_pre_refunds = IpPreRefund::latest()->get();
    }

    public function render()
    {
        return view('livewire.ipd.in-patient-pre-refund.in-patient-pre-refund-list')->extends('layouts.admin')->section('content');
    }
}

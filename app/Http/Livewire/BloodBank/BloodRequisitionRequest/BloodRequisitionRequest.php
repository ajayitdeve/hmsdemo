<?php

namespace App\Http\Livewire\BloodBank\BloodRequisitionRequest;

use App\Models\BloodRequisitionRequest as ModelsBloodRequisitionRequest;
use Faker\Core\Blood;
use Livewire\Component;

class BloodRequisitionRequest extends Component
{
    public $blood_requisition_requests = [];
    public function mount()
    {
        $this->blood_requisition_requests = ModelsBloodRequisitionRequest::latest()->get();
    }

    public function render()
    {
        return view('livewire.blood-bank.blood-requisition-request.blood-requisition-request')->extends('layouts.admin')->section('content');
    }
}

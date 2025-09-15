<?php

namespace App\Http\Livewire\BloodBank\DonorQuestionnaireConsent;

use App\Models\BloodDonorQuestionnaireConsent;
use Livewire\Component;

class DonorQuestionnaireConsent extends Component
{
    public $donor_questionnaire_consents;

    public function mount()
    {
        $this->donor_questionnaire_consents = BloodDonorQuestionnaireConsent::latest()->get();
    }
    public function render()
    {
        return view('livewire.blood-bank.donor-questionnaire-consent.donor-questionnaire-consent')->extends('layouts.admin')->section('content');
    }
}

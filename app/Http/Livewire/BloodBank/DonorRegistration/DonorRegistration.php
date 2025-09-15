<?php

namespace App\Http\Livewire\BloodBank\DonorRegistration;

use App\Models\Donor;
use Livewire\Component;

class DonorRegistration extends Component
{
    public $donor_list = [];

    public function mount()
    {
        $this->donor_list = Donor::latest()->get();
    }
    public function render()
    {
        return view('livewire.blood-bank.donor-registration.donor-registration')->extends('layouts.admin')->section('content');
    }
}

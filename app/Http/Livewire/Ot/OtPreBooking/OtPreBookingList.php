<?php

namespace App\Http\Livewire\Ot\OtPreBooking;

use App\Models\OtPreBooking;
use Livewire\Component;

class OtPreBookingList extends Component
{
    public $ot_pre_bookings = [];

    public function mount()
    {
        $this->ot_pre_bookings = OtPreBooking::latest()->get();
    }

    public function render()
    {
        return view('livewire.ot.ot-pre-booking.ot-pre-booking-list')->extends('layouts.admin')->section('content');
    }
}

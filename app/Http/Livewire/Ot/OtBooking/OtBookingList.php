<?php

namespace App\Http\Livewire\Ot\OtBooking;

use App\Models\OtBooking;
use App\Models\User;
use Livewire\Component;

class OtBookingList extends Component
{
    public $ot_booking_id, $reason, $approved_by, $show_cancel_button = false;
    public $ot_bookings = [], $users = [];

    public function mount()
    {
        $this->ot_bookings = OtBooking::latest()->get();
        $this->users = User::all();
    }

    public function booking_cancel_view($id, $show_cancel_button = false)
    {
        $this->reset(['ot_booking_id', 'reason', 'approved_by', 'show_cancel_button']);

        $this->ot_booking_id = $id;
        $ot_booking = OtBooking::find($id);
        if ($ot_booking) {
            $this->reason = $ot_booking->cancelled_reason;
            $this->approved_by = $ot_booking->cancelled_approved_by_id;

            if ($show_cancel_button) {
                $this->show_cancel_button = true;
            }

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function booking_cancel()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $ot_booking = OtBooking::with(['day_care', 'pre_operation', 'post_operation'])->find($this->ot_booking_id);

        if ($ot_booking) {
            if ($ot_booking?->day_care()->count() > 0 || $ot_booking?->pre_operation()->count() > 0 || $ot_booking?->post_operation()->count() > 0) {
                session()->flash('error', 'OT Booking is already used you can\'t cancel.');
                return;
            }

            $ot_booking->is_cancelled = true;
            $ot_booking->cancelled_reason = $this->reason;
            $ot_booking->cancelled_approved_by_id = $this->approved_by;
            $ot_booking->save();

            session()->flash('success', 'OT Booking is cancelled.');
            $this->dispatchBrowserEvent('hide-cancel-modal');
            $this->ot_bookings = OtBooking::latest()->get();
        }

        session()->flash('error', 'Something went wrong.');
    }

    public function render()
    {
        return view('livewire.ot.ot-booking.ot-booking-list')->extends('layouts.admin')->section('content');
    }
}

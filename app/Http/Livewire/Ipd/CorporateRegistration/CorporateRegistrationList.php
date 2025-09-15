<?php

namespace App\Http\Livewire\Ipd\CorporateRegistration;

use App\Models\Ipd\CorporateRegistration as IpCorporateRegistration;
use App\Models\User;
use Livewire\Component;

class CorporateRegistrationList extends Component
{
    public $corporate_registration_id, $reason, $approved_by, $show_cancel_button;
    public $corporate_registration_list, $users;

    public function mount()
    {
        $this->corporate_registration_list = IpCorporateRegistration::latest()->get();
        $this->users = User::all();
    }

    public function view_cancel_registration($corporate_registration_id, $show_cancel_button = false)
    {
        $this->reset(['corporate_registration_id', 'reason', 'approved_by', 'show_cancel_button']);

        $this->corporate_registration_id = $corporate_registration_id;
        $corporate_registration = IpCorporateRegistration::find($this->corporate_registration_id);
        if ($corporate_registration) {
            $this->reason = $corporate_registration->cancelled_reason;
            $this->approved_by = $corporate_registration->cancelled_by_id;

            if ($show_cancel_button) {
                $this->show_cancel_button = true;
            }

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function cancel_registration()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $corporate_registration = IpCorporateRegistration::find($this->corporate_registration_id);
        if ($corporate_registration) {

            if ($corporate_registration->ipd) {
                session()->flash('error', 'IPD exist you can not cancel');
                $this->reset(['corporate_registration_id', 'reason', 'approved_by']);
                $this->dispatchBrowserEvent('hide-cancel-modal');
                return;
            }


            $corporate_registration->is_cancelled = 1;
            $corporate_registration->cancelled_reason = $this->reason;
            $corporate_registration->cancelled_by_id = $this->approved_by;
            $corporate_registration->save();

            $this->reset(['corporate_registration_id', 'reason', 'approved_by']);
            $this->mount();
            $this->dispatchBrowserEvent('hide-cancel-modal');
        }
    }

    public function render()
    {
        return view('livewire.ipd.corporate-registration.corporate-registration-list')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\FrontDesk;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\OpdBilling;
use App\Models\ConsultationCharge;
use Illuminate\Support\Facades\Auth;

class TodayUserWiseCollection extends Component
{
    public $userId, $consulationCharges = [], $opdBillings = [], $user;
    public function mount()
    {
        $userId = Auth::user()?->id;
        $this->userId = $userId;
        $this->user = Auth::user();
        // dd($userId);
    }
    public function render()
    {
        $today = Carbon::today()->toDateString();

        //user wise cash collection
        //1- consultation_charges 2-opd_billings & opd_billing_items
        $this->consulationCharges = ConsultationCharge::where('received_by_id', $this->userId)->whereDate('created_at', $today)->get();
        $this->consulationCharges = collect($this->consulationCharges);
        //$sumConsulatationCharge=$consulationCharges->sum('amount');
        $this->opdBillings = OpdBilling::where('created_by_id', $this->userId)->whereDate('created_at', $today)->get();
        $this->opdBillings = collect($this->opdBillings);
        return view('livewire.front-desk.today-user-wise-collection')->extends('layouts.admin')->section('content');
    }
}

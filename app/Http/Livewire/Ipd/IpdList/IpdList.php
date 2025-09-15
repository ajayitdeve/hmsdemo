<?php

namespace App\Http\Livewire\Ipd\IpdList;

use App\Models\Ipd\Ipd;
use Livewire\Component;

class IpdList extends Component
{
    public $ipd_list = [], $ipd_details = null;

    public function mount()
    {
        $today = request()->query('today');

        $this->ipd_list = Ipd::when($today, function ($query) {
                return $query->whereDate('created_at', today());
            })->latest()->get();

        if (session()->has('ipd_id')) {
            $this->ipd_details = Ipd::findOrFail(session()->get('ipd_id'));
        }

        // $this->ipd_details = Ipd::findOrFail(15);
    }

    public function render()
    {
        return view('livewire.ipd.ipd-list.ipd-list')->extends('layouts.admin')->section('content');
    }
}

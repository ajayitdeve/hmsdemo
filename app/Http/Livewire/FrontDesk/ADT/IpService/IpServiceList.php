<?php

namespace App\Http\Livewire\FrontDesk\Adt\IpService;

use App\Models\IpServiceBilling;
use Livewire\Component;

class IpServiceList extends Component
{
    public $ipd;
    protected $queryString = ['ipd'];

    public $ip_service_billings = [];

    public function mount()
    {
        $this->ip_service_billings = IpServiceBilling::where("created_by_id", auth()->user()?->id)
            ->when($this->ipd, function ($query) {
                $query->whereHas('ipd', function ($subQuery) {
                    $subQuery->where('ipdcode', $this->ipd);
                });
            })
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.front-desk.adt.ip-service.ip-service-list')->extends('layouts.admin')->section('content');
    }
}

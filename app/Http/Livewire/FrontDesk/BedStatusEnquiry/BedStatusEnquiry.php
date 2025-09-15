<?php

namespace App\Http\Livewire\FrontDesk\BedStatusEnquiry;

use App\Models\Ipd\NurseStation;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use Livewire\Component;

class BedStatusEnquiry extends Component
{
    public $selection_type = 'ward-wise', $ward_id, $nursestation_id;

    public $wards = [];
    public $nursestations = [];

    public $bed_status_enquiries = [];

    public $selection_types = [
        'ward-wise' => 'Ward Wise',
        'nursestation-wise' => 'Nursestation Wise',
    ];

    public function mount()
    {
        $this->wards = Ward::get();
        $this->nursestations = NurseStation::get();
    }

    public function selectionTypeChanged()
    {
        $this->reset([
            'ward_id',
            'nursestation_id',
            'bed_status_enquiries',
        ]);
    }

    public function show()
    {
        $this->validate([
            'selection_type' => 'required',
        ]);

        $this->bed_status_enquiries = Ward::query()
            ->with(['rooms.room_beds'])
            ->when($this->ward_id, function ($query) {
                $query->where('id', $this->ward_id);
            })
            ->when($this->selection_type == 'nursestation-wise', function ($query) {
                $query->whereHas('rooms', function ($q) {
                    $q->when($this->nursestation_id, function ($q1) {
                        $q1->where('nurse_station_id', $this->nursestation_id);
                    });
                });
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.front-desk.bed-status-enquiry.bed-status-enquiry')->extends('layouts.admin')->section('content');
    }
}

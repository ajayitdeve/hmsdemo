<?php

namespace App\Http\Livewire\Master\CorporateServiceFee;

use App\Models\CorporateServiceFee;
use App\Models\CostCenter;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use App\Models\Service\Teriff;
use Livewire\Component;

class CorporateServiceFeeMaster extends Component
{
    public $teriff_id, $teriff_code, $service_group_id, $service_group_code, $cost_center_id;
    public $teriffs = [];
    public $service_groups = [];
    public $cost_centers = [];

    public $services = [];

    public function mount()
    {
        $this->teriffs = Teriff::get();
        $this->service_groups = ServiceGroup::get();
        $this->cost_centers = CostCenter::get();

        $this->cost_center_id = CostCenter::value("id");
    }

    protected $rules = [
        'services.*.corporate_service_fee.code' => 'nullable|string',
        'services.*.corporate_service_fee.name' => 'nullable|string',
        'services.*.corporate_service_fee.charge' => 'nullable|numeric',
    ];

    public function teriffChanged()
    {
        $teriff = Teriff::find($this->teriff_id);
        if ($teriff) {
            $this->teriff_code = $teriff?->code;
        }
    }

    public function serviceGroupChanged()
    {
        $service_group = ServiceGroup::find($this->service_group_id);
        if ($service_group) {
            $this->service_group_code = $service_group?->code;
        }
    }

    public function show()
    {
        $this->services = Service::query()
            ->with(['corporate_service_fee'])
            ->when($this->teriff_id, function ($query) {
                $query->where('teriff_id', $this->teriff_id);
            })
            ->when($this->service_group_id, function ($query) {
                $query->where('service_group_id', $this->service_group_id);
            })
            ->when($this->cost_center_id, function ($query) {
                $query->where('cost_center_id', $this->cost_center_id);
            })
            ->get();
    }

    public function save()
    {
        $this->validate();

        if (count($this->services) > 0) {
            foreach ($this->services as $service) {
                CorporateServiceFee::updateOrCreate(
                    ['service_id' => $service['id']],
                    [
                        'code' => $service['corporate_service_fee']['code'] ?? null,
                        'name' => $service['corporate_service_fee']['name'] ?? null,
                        'charge' => $service['corporate_service_fee']['charge'] ?? null,
                        'created_by_id' => auth()->user()->id
                    ]
                );
            }

            session()->flash('success', 'Corporate Services Updated Successfully!');
            return;
        }

        session()->flash('error', 'No Services Found...!');
    }

    public function render()
    {
        return view('livewire.master.corporate-service-fee.corporate-service-fee-master')->extends('layouts.admin')->section('content');
    }
}

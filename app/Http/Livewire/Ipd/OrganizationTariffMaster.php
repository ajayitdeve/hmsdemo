<?php

namespace App\Http\Livewire\Ipd;

use App\Models\CostCenter;
use App\Models\Ipd\Organization;
use App\Models\Ipd\OrganizationTariff;
use App\Models\OrganizationTariffPriority;
use App\Models\Service\Teriff;
use Livewire\Component;

class OrganizationTariffMaster extends Component
{
    public $organization_id, $organization_code;

    public $tariff_ip_cart = [];
    public $tariff_op_cart = [];
    public $organizations = [];
    public $tariffs = [];

    public function mount()
    {
        $this->organizations = Organization::latest()->get();
        $this->tariffs = Teriff::latest()->get();

        $this->tariff_ip_cart = [
            [
                "priority" => 1,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "ip",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 2,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "ip",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 3,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "ip",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 4,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "ip",
                "is_default" => 1,
                "discount" => "",
            ]
        ];

        $this->tariff_op_cart = [
            [
                "priority" => 1,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "op",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 2,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "op",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 3,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "op",
                "is_default" => 0,
                "discount" => "",
            ],
            [
                "priority" => 4,
                "teriff_id" => "",
                "teriff_code" => "",
                "type" => "op",
                "is_default" => 1,
                "discount" => "",
            ]
        ];
    }

    public function organizationChanged()
    {
        $organization = Organization::where('id', $this->organization_id)->first();
        if ($organization) {
            $this->organization_code = $organization->code;

            $organization_tariff = OrganizationTariff::with(["teriff_priority"])->where('organization_id', $this->organization_id)->first();
            if ($organization_tariff) {
                $organization_tariff->teriff_priority()->get()->map(function ($item) {
                    $item->teriff_id = $item?->teriff_id ?? "";
                    $item->teriff_code = $item?->teriff?->code;

                    if ($item->type == 'ip') {
                        $this->tariff_ip_cart[$item->priority - 1] = $item;
                    } else {
                        $this->tariff_op_cart[$item->priority - 1] = $item;
                    }
                });
            }
        }
    }

    public function ipTarrifChanged($index)
    {
        $tariff = Teriff::find($this->tariff_ip_cart[$index]['teriff_id']);
        if ($tariff) {
            $this->tariff_ip_cart[$index]['teriff_code'] = $tariff->code;
        } else {
            $this->tariff_ip_cart[$index]['teriff_code'] = "";
        }
    }

    public function opTarrifChanged($index)
    {
        $tariff = Teriff::find($this->tariff_op_cart[$index]['teriff_id']);
        if ($tariff) {
            $this->tariff_op_cart[$index]['teriff_code'] = $tariff->code;
        } else {
            $this->tariff_op_cart[$index]['teriff_code'] = "";
        }
    }

    public function rules()
    {
        return [
            'organization_id' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        $tariff_cart = array_merge($this->tariff_ip_cart, $this->tariff_op_cart);

        if ($tariff_cart && is_array($tariff_cart)) {
            $organization_tariff = OrganizationTariff::firstOrCreate([
                'organization_id' => $this->organization_id,
            ]);


            foreach ($tariff_cart as $tariff_item) {
                OrganizationTariffPriority::updateOrCreate(
                    [
                        'organization_tariff_id' => $organization_tariff->id,
                        'organization_id' => $this->organization_id,
                        'type' => $tariff_item['type'],
                        'is_default' => $tariff_item['is_default'],
                        'priority' => $tariff_item['priority'],
                    ],
                    [
                        'teriff_id' => $tariff_item["teriff_id"] ?: null,
                        'discount' => $tariff_item['discount'] ?: 0,
                    ]
                );
            }

            session()->flash('success', 'Organization Tariff Master Saved Successfully');

            $this->reset();
            $this->mount();
        } else {
            session()->flash('error', 'Something went wront ! Try Again');
        }
    }

    public function render()
    {
        $organization_tariffs = OrganizationTariff::with(["organization.cost_center"])
            ->latest()
            ->get();

        return view('livewire.ipd.organization-tariff-master', compact('organization_tariffs'))->extends('layouts.admin')->section('content');
    }
}

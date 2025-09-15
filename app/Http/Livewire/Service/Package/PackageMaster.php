<?php

namespace App\Http\Livewire\Service\Package;

use Livewire\Component;
use App\Models\CostCenter;
use App\Models\Service\Teriff;
use App\Models\Service\Package;
use App\Models\Service\Service;
use App\Models\Service\Location;
use App\Models\Service\BillingHead;
use App\Models\Service\ServiceGroup;

class PackageMaster extends Component
{
    public $teriff_id, $service_group_id, $billing_head_id, $cost_center_id, $location_id, $code, $name, $charge, $emergency_charge, $type, $isactive = true, $hospital_percent, $doctor_percent, $hospital_amount, $doctor_amount, $ispackage, $isprocedure, $isoutside, $issampleneeded, $isdiet, $isneverexpired;
    public $user, $teriffs = [], $servicegroups = [], $billingheads = [], $costcenters = [], $locations = [];
    public $service_id;
    public $selected = [];

    public function selectedServices()
    {
        dd($this->selected);
    }

    public function mount()
    {
        $this->teriffs = Teriff::get();
        $this->servicegroups = ServiceGroup::get();
        $this->billingheads = BillingHead::get();
        $this->costcenters = CostCenter::get();
        $this->locations = Location::get();
        $this->user = Auth()->user();
        $this->ispackage = true;
        $this->isprocedure = false;
        $this->isoutside = false;
        $this->issampleneeded = false;
        $this->isdiet = false;
        $this->isactive = true;
        $this->isneverexpired = false;
    }

    function rules()
    {
        return [
            'teriff_id' => 'required',
            'service_group_id' => 'required',
            'billing_head_id' => 'required',
            'cost_center_id' => 'required',
            'location_id' => 'required',
            // 'code' => 'required',
            'name' => 'required',
            'charge' => 'required',
            'emergency_charge' => 'required',
            'type' => 'required',
            'isactive' => 'required',
            'hospital_percent' => 'required',
            'doctor_percent' => 'required',
            'hospital_amount' => 'required',
            'doctor_amount' => 'required',
            // 'ispackage' => 'required',
            // 'isprocedure' => 'required',
            // 'isoutside' => 'required',
            // 'issampleneeded' => 'required',
            // 'isdiet' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        //checking if any service is selected to create package or not

        if (count($this->selected)) {
            $service = [
                'teriff_id' => $this->teriff_id,
                'service_group_id' => $this->service_group_id,
                'billing_head_id' => $this->billing_head_id,
                'cost_center_id' => $this->cost_center_id,
                'location_id' => $this->location_id,
                'code' => $this->getServiceCode(Service::max('id')),
                'name' => $this->name,
                'charge' => $this->charge,
                'emergency_charge' => $this->emergency_charge,
                'type' => $this->type,
                'isactive' => $this->isactive,
                'hospital_percent' => $this->hospital_percent,
                'doctor_percent' => $this->doctor_percent,
                'hospital_amount' => $this->hospital_amount,
                'doctor_amount' => $this->doctor_amount,
                'ispackage' => $this->ispackage,
                'isprocedure' => $this->isprocedure,
                'isoutside' => $this->isoutside,
                'issampleneeded' => $this->issampleneeded,
                'isdiet' => $this->isdiet,
                //additional fields
                'created_by_id' => $this->user->id,
                'modified_by_id' => $this->user->id,

            ];
            $result = Service::create($service);
            if ($result) {
                //now add data to packages table
                $data = [];
                //'package_id', 'service_id', 'created_by_id', 'updated_by_id'
                foreach ($this->selected as $selectedService) {
                    array_push($data, [
                        'package_id' => $result->id,
                        'service_id' => $selectedService,
                        'created_by_id' => $this->user->id,
                        'updated_by_id' => $this->user->id
                    ]);

                    $x = Package::insert($data);
                }
                session()->flash('message', 'Package Added Successfully.');
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal');
            } else {
                session()->flash('message', 'Something went wront ! Try Again');
                $this->resetInput();
                $this->dispatchBrowserEvent('close-modal');
            }
        } else {
            session()->flash('error', 'At least one service is required to create a service');
        }
    }
    public function getServiceCode($maxId)
    {
        if (isset($this->service_group_id)) {
            //get service_group code
            $serviceGroup = ServiceGroup::find($this->service_group_id);
            if ($maxId < 10) {
                return $serviceGroup->code . '0' . $maxId + 1;
            } else {
                return  $serviceGroup->code . $maxId + 1;
            }
        }
    }
    public function closeModal()
    {
        $this->reset();
        $this->teriffs = Teriff::get();
        $this->servicegroups = ServiceGroup::get();
        $this->billingheads = BillingHead::get();
        $this->costcenters = CostCenter::get();
        $this->locations = Location::get();
        $this->user = Auth()->user();
    }
    public function resetInput()
    {
        $this->reset();
        $this->mount();
    }

    public function edit(int $service_id)
    {
        $this->service_id = $service_id;
        $service = Service::find($service_id);
        if ($service) {
            $this->service_id = $service_id;
            $this->teriff_id = $service->teriff_id;
            $this->service_group_id = $service->service_group_id;
            $this->billing_head_id = $service->billing_head_id;
            $this->cost_center_id = $service->cost_center_id;
            $this->location_id = $service->location_id;
            $this->code = $service->code;
            $this->name = $service->name;
            $this->charge = $service->charge;
            $this->emergency_charge = $service->emergency_charge;
            $this->type = $service->type;
            $this->isactive = $service->isactive;
            $this->hospital_percent = $service->hospital_percent;
            $this->doctor_percent = $service->doctor_percent;
            $this->hospital_amount = $service->hospital_amount;
            $this->doctor_amount = $service->doctor_amount;
            $this->ispackage = $service->ispackage;
            $this->isprocedure = $service->isprocedure;
            $this->isoutside = $service->isoutside;
            $this->issampleneeded = $service->issampleneeded;
            $this->isdiet = $service->isdiet;
        } else {
        }
    }

    public function update()
    {
        // $this->validate();
        $data = [
            'teriff_id' => $this->teriff_id,
            'service_group_id' => $this->service_group_id,
            'billing_head_id' => $this->billing_head_id,
            'cost_center_id' => $this->cost_center_id,
            'location_id' => $this->location_id,
            'code' => $this->code,
            'name' => $this->name,
            'charge' => $this->charge,
            'emergency_charge' => $this->emergency_charge,
            'type' => $this->type,
            'isactive' => $this->isactive,
            'hospital_percent' => $this->hospital_percent,
            'doctor_percent' => $this->doctor_percent,
            'hospital_amount' => $this->hospital_amount,
            'doctor_amount' => $this->doctor_amount,
            'ispackage' => $this->ispackage,
            'isprocedure' => $this->isprocedure,
            'isoutside' => $this->isoutside,
            'issampleneeded' => $this->issampleneeded,
            'isdiet' => $this->isdiet,
        ];
        Service::where('id', $this->service_id)->first()->update($data);
        session()->flash('message', 'Service Updated  Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function delete(int $service_id)
    {
        $this->service_id = $service_id;
    }

    public function destroy()
    {
        Service::find($this->service_id)->delete();
        session()->flash('message', 'Service  deleted Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $services = Service::where('ispackage', false)->get();
        $packages = Service::where('ispackage', true)->get();
        return view('livewire.service.package.package-master', ['packages' => $packages, 'services' => $services])->extends('layouts.admin')->section('content');
    }
}

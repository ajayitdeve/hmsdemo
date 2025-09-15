<?php

namespace App\Http\Livewire\Service\Service;

use Livewire\Component;
use App\Models\CostCenter;
use App\Models\Department;
use App\Models\Service\Teriff;
use App\Models\Service\Service;
use App\Models\Service\Location;
use App\Models\Service\BillingHead;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\DB;

class ServiceMaster extends Component
{
    public $teriff_id, $department_id, $service_group_id, $billing_head_id, $cost_center_id, $location_id, $code, $name, $charge = 0, $emergency_charge = 0, $type, $isactive = true, $hospital_percent = 0, $doctor_percent = 0, $hospital_amount = 0, $doctor_amount = 0, $ispackage, $isprocedure, $isoutside, $issampleneeded, $isdiet, $isneverexpired;
    public $user, $teriffs = [], $departments = [], $servicegroups = [], $billingheads = [], $costcenters = [], $locations = [];
    public $service_id, $remarks;
    public $percentage;

    public function mount()
    {
        $this->teriffs = Teriff::get();
        $this->departments = Department::get();
        $this->servicegroups = [];
        $this->billingheads = BillingHead::get();
        $this->costcenters = CostCenter::get();
        $this->locations = Location::get();
        $this->user = Auth()->user();
        $this->ispackage = false;
        $this->isprocedure = false;
        $this->isoutside = false;
        $this->issampleneeded = false;
        $this->isdiet = false;
        $this->isactive = true;
        $this->isneverexpired = false;

        $this->cost_center_id = CostCenter::first()?->id;
        $this->location_id = Location::first()?->id;
    }

    function rules()
    {
        return [
            'teriff_id' => 'required',
            'department_id' => 'required',
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
            'ispackage' => 'nullable',
            'isprocedure' => 'nullable',
            'isoutside' => 'nullable',
            'issampleneeded' => 'nullable',
            'isdiet' => 'nullable',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        $service = [
            'teriff_id' => $this->teriff_id,
            'department_id' => $this->department_id,
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
            'ispackage' => $this->ispackage ? true : false,
            'isprocedure' => $this->isprocedure ? true : false,
            'isoutside' => $this->isoutside ? true : false,
            'issampleneeded' => $this->issampleneeded ? true : false,
            'isdiet' => $this->isdiet ? true : false,
            'remarks' => $this->remarks,
            //additional fields
            'created_by_id' => $this->user->id,
            'modified_by_id' => $this->user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        $result = Service::insert($service);
        if ($result) {
            session()->flash('message', 'Service Added Successfully.');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        } else {
            session()->flash('message', 'Something went wront ! Try Again');
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
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
        $this->resetInput();
    }

    public function resetInput()
    {
        $this->reset([
            'teriff_id',
            'department_id',
            'service_group_id',
            'servicegroups',
            'billing_head_id',
            // 'cost_center_id',
            // 'location_id',
            'code',
            'type',
            'name',
            'remarks',
            'charge',
            'emergency_charge',
            'hospital_percent',
            'hospital_amount',
            'doctor_percent',
            'doctor_amount',
            'ispackage',
            'isprocedure',
            'isoutside',
            'issampleneeded',
            'isdiet',
            'isactive',
        ]);
    }

    public function resetInputDefault()
    {
        $this->reset([
            'teriff_id',
            'department_id',
            'service_group_id',
            'servicegroups',
            'billing_head_id',
            'code',
            'type',
            'name',
            'remarks',
            'charge',
            'emergency_charge',
            'hospital_percent',
            'hospital_amount',
            'doctor_percent',
            'doctor_amount',
            'ispackage',
            'isprocedure',
            'isoutside',
            'issampleneeded',
            'isdiet',
            'isactive',
        ]);
    }

    public function edit(int $service_id)
    {
        $service = Service::find($service_id);
        if ($service) {
            $this->service_id = $service_id;
            $this->teriff_id = $service->teriff_id;
            $this->department_id = $service->department_id;
            $this->service_group_id = $service->service_group_id;
            $this->servicegroups = ServiceGroup::where('department_id', $service->department_id)->get();
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
            $this->remarks = $service->remarks;
        } else {
        }
    }

    public function update()
    {
        $this->validate();

        $data = [
            'teriff_id' => $this->teriff_id,
            'department_id' => $this->department_id,
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
            'ispackage' => $this->ispackage ? true : false,
            'isprocedure' => $this->isprocedure ? true : false,
            'isoutside' => $this->isoutside ? true : false,
            'issampleneeded' => $this->issampleneeded ? true : false,
            'isdiet' => $this->isdiet ? true : false,
            'remarks' => $this->remarks,
        ];

        Service::where('id', $this->service_id)->first()->update($data);
        session()->flash('message', 'Service Updated Successfully.');
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
        session()->flash('message', 'Service deleted Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function departmentChanged()
    {
        $this->servicegroups = ServiceGroup::where('department_id', $this->department_id)->get();
    }

    public function chargeChange()
    {
        if ($this->charge < 0) {
            $this->charge = 0;
        }
        $this->hospital_amount = $this->charge;
        $this->hospitalAmountChange();
    }

    public function hospitalPercentChange()
    {
        if ($this->hospital_percent > 100) {
            $this->hospital_percent = 100;
        }
        $this->hospital_amount = number_format(($this->charge * $this->hospital_percent) / 100, 2, '.', '');
        $this->doctor_amount = number_format($this->charge - $this->hospital_amount, 2, '.', '');
        $this->doctor_percent = number_format(($this->doctor_amount * 100) / $this->charge, 2, '.', '');
    }

    public function hospitalAmountChange()
    {
        if ($this->hospital_amount > $this->charge) {
            $this->hospital_amount = $this->charge;
        }
        $this->hospital_percent = number_format(($this->hospital_amount * 100) / $this->charge, 2, '.', '');
        $this->doctor_amount = number_format($this->charge - $this->hospital_amount, 2, '.', '');
        $this->doctor_percent = number_format(($this->doctor_amount * 100) / $this->charge, 2, '.', '');
        if ($this->doctor_percent > 100) {
            $this->doctor_percent = 100;
        }
    }

    public function doctorPercentChange()
    {
        if ($this->doctor_percent > 100) {
            $this->doctor_percent = 100;
        }
        $this->doctor_amount = number_format(($this->charge * $this->doctor_percent) / 100, 2, '.', '');
        $this->hospital_amount = number_format($this->charge - $this->doctor_amount, 2, '.', '');
        $this->hospital_percent = number_format(($this->hospital_amount * 100) / $this->charge, 2, '.', '');
    }

    public function doctorAmountChange()
    {
        if ($this->doctor_amount > $this->charge) {
            $this->doctor_amount = $this->charge;
        }
        $this->doctor_percent = number_format(($this->doctor_amount * 100) / $this->charge, 2, '.', '');
        $this->hospital_amount = number_format($this->charge - $this->doctor_amount, 2, '.', '');
        $this->hospital_percent = number_format(($this->hospital_amount * 100) / $this->charge, 2, '.', '');
        if ($this->hospital_percent > 100) {
            $this->hospital_percent = 100;
        }
    }

    public function add_increment()
    {
        $this->validate([
            'percentage' => 'required|numeric|not_in:0'
        ]);

        $multiplier = 1 + ($this->percentage / 100);

        Service::query()->update([
            'hospital_amount' => DB::raw('ROUND((charge * ' . $multiplier . ') * hospital_percent / 100, 2)'),
            'doctor_amount'   => DB::raw('ROUND((charge * ' . $multiplier . ') * doctor_percent / 100, 2)'),
            'charge'          => DB::raw('ROUND(charge * ' . $multiplier . ', 2)'),
        ]);

        session()->flash('message', 'Service Updated Successfully.');
        $this->reset(['percentage']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        $services = Service::orderBy('id', 'DESC')->get();

        return view('livewire.service.service.service-master', ['services' => $services])->extends('layouts.admin')->section('content');
    }
}

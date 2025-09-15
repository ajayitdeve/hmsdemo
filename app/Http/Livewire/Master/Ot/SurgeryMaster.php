<?php

namespace App\Http\Livewire\Master\Ot;

use App\Models\Department;
use App\Models\Service\Service;
use App\Models\Service\Teriff;
use App\Models\Surgery;
use App\Models\SurgeryType;
use Livewire\Component;
use Livewire\WithPagination;

class SurgeryMaster extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $surgery_id, $tariff_id, $tariff_code, $service_id, $service_code, $surgery_type_id, $surgery_type_code, $department_id, $department_code;
    public $surgery_code, $surgery_amount, $estimated_duration, $equ_service, $effect_from, $effect_to, $service_group_id, $service_group, $description, $s1, $s2;
    public $payment_on, $general_ward_amount, $semi_private_amount, $private_amount, $delux_amount, $triplesharing_amount, $iccu_amount;
    public $tariffs = [], $services = [], $surgery_types = [], $departments = [];
    public $surgery_list = [];

    public function mount()
    {
        $this->tariffs = Teriff::latest()->get();
        $this->services = Service::where("isactive", 1)->where("isprocedure", 1)->get();
        $this->surgery_types = SurgeryType::get();
        $this->departments = Department::get();
        $this->generate_code();
        $this->surgery_list = Surgery::latest()->get();
    }

    public function generate_code()
    {
        $this->surgery_code = "SRG" . Surgery::max('id') + 1;
        $this->effect_from = date('Y-m-d');
        $this->effect_to = date('Y-m-d');
    }

    public function changedTariff()
    {
        $tariff = Teriff::find($this->tariff_id);
        if ($tariff) {
            $this->tariff_code = $tariff->code;
        } else {
            $this->tariff_code = "";
        }
    }

    public function changedService()
    {
        $service = Service::find($this->service_id);
        if ($service) {
            $this->service_code = $service->code;
            $this->surgery_amount = $service->charge;
            $this->service_group_id = $service->service_group_id;
            $this->service_group = $service?->servicegroup?->code;
        } else {
            $this->service_code = "";
            $this->surgery_amount = "";
            $this->service_group_id = "";
            $this->service_group = "";
        }
    }

    public function changedSurgeryType()
    {
        $surgery_type = SurgeryType::find($this->surgery_type_id);
        if ($surgery_type) {
            $this->surgery_type_code = $surgery_type->code;
        } else {
            $this->surgery_type_code = "";
        }
    }

    public function changedDepartment()
    {
        $department = Department::find($this->department_id);
        if ($department) {
            $this->department_code = $department->code;
        } else {
            $this->department_code = "";
        }
    }

    public function rules()
    {
        return [
            'tariff_id' => 'required',
            'service_id' => 'required',
            'surgery_type_id' => 'required',
            'department_id' => 'required',
            'service_code' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();

        Surgery::create([
            'teriff_id' => $this->tariff_id,
            'service_id' => $this->service_id,
            'service_group_id' => $this->service_group_id,
            'surgery_type_id' => $this->surgery_type_id,
            'department_id' => $this->department_id,
            'code' => $this->surgery_code,
            'amount' => $this->surgery_amount,
            'duration' => $this->estimated_duration,
            'effect_from' => date("Y-m-d", strtotime($this->effect_from)),
            'effect_to' => date("Y-m-d", strtotime($this->effect_to)),
            'description' => $this->description,
            's1' => $this->s1,
            's2' => $this->s2,

            'payment_on' => $this->payment_on ?? null,
            'general_ward_amount' => $this->general_ward_amount ?? null,
            'semi_private_amount' => $this->semi_private_amount ?? null,
            'private_amount' => $this->private_amount ?? null,
            'delux_amount' => $this->delux_amount ?? null,
            'triplesharing_amount' => $this->triplesharing_amount ?? null,
            'iccu_amount' => $this->iccu_amount ?? null,

            'created_by_id' => auth()->user()?->id,
        ]);

        session()->flash('success', 'Surgery Added Successfully.');
        $this->reset([
            'surgery_id',
            'tariff_id',
            'tariff_code',
            'service_id',
            'service_code',
            'surgery_type_id',
            'surgery_type_code',
            'department_id',
            'department_code',
            'surgery_code',
            'surgery_amount',
            'estimated_duration',
            'equ_service',
            'service_group',
            'description',
            's1',
            's2',
            'payment_on',
            'general_ward_amount',
            'semi_private_amount',
            'private_amount',
            'delux_amount',
            'triplesharing_amount',
            'iccu_amount'
        ]);
        $this->generate_code();
        $this->surgery_list = Surgery::latest()->get();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit($id)
    {
        $surgery = Surgery::find($id);
        if ($surgery) {
            $this->surgery_id = $surgery->id;
            $this->tariff_id = $surgery->teriff_id;
            $this->changedTariff();
            $this->service_id = $surgery->service_id;
            $this->changedService();
            $this->surgery_type_id = $surgery->surgery_type_id;
            $this->changedSurgeryType();
            $this->department_id = $surgery->department_id;
            $this->changedDepartment();
            $this->surgery_code = $surgery->code;
            $this->surgery_amount = $surgery->amount;
            $this->estimated_duration = $surgery->duration;
            $this->effect_from = $surgery->effect_from;
            $this->effect_to = $surgery->effect_to;
            $this->description = $surgery->description;
            $this->s1 = $surgery->s1;
            $this->s2 = $surgery->s2;

            $this->payment_on = $surgery->payment_on;
            $this->general_ward_amount = $surgery->general_ward_amount;
            $this->semi_private_amount = $surgery->semi_private_amount;
            $this->private_amount = $surgery->private_amount;
            $this->delux_amount = $surgery->delux_amount;
            $this->triplesharing_amount = $surgery->triplesharing_amount;
            $this->iccu_amount = $surgery->iccu_amount;
        }
    }

    public function update()
    {
        $this->validate();
        $surgery = Surgery::find($this->surgery_id);
        if ($surgery) {
            $surgery->update([
                'teriff_id' => $this->tariff_id,
                'service_id' => $this->service_id,
                'service_group_id' => $this->service_group_id,
                'surgery_type_id' => $this->surgery_type_id,
                'department_id' => $this->department_id,
                'amount' => $this->surgery_amount,
                'duration' => $this->estimated_duration,
                'effect_from' => date("Y-m-d", strtotime($this->effect_from)),
                'effect_to' => date("Y-m-d", strtotime($this->effect_to)),
                'description' => $this->description,
                's1' => $this->s1,
                's2' => $this->s2,

                'payment_on' => $this->payment_on ?? null,
                'general_ward_amount' => $this->general_ward_amount ?: null,
                'semi_private_amount' => $this->semi_private_amount ?: null,
                'private_amount' => $this->private_amount ?: null,
                'delux_amount' => $this->delux_amount ?: null,
                'triplesharing_amount' => $this->triplesharing_amount ?: null,
                'iccu_amount' => $this->iccu_amount ?: null,
            ]);

            session()->flash('success', 'Surgery Updated Successfully.');
            $this->reset([
                'surgery_id',
                'tariff_id',
                'tariff_code',
                'service_id',
                'service_code',
                'surgery_type_id',
                'surgery_type_code',
                'department_id',
                'department_code',
                'surgery_code',
                'surgery_amount',
                'estimated_duration',
                'equ_service',
                'service_group',
                'description',
                's1',
                's2',
                'payment_on',
                'general_ward_amount',
                'semi_private_amount',
                'private_amount',
                'delux_amount',
                'triplesharing_amount',
                'iccu_amount'
            ]);
            $this->generate_code();
            $this->surgery_list = Surgery::latest()->get();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function render()
    {
        return view('livewire.master.ot.surgery-master')->extends('layouts.admin')->section('content');
    }
}

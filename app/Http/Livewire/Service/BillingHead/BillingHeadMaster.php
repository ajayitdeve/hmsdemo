<?php

namespace App\Http\Livewire\Service\BillingHead;

use App\Models\Service\BillingHead;
use Livewire\Component;

class BillingHeadMaster extends Component
{
    public $name, $billing_head_id;

    public function mount() {}

    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        $this->validate();
        BillingHead::create([
            'name' => $this->name,
        ]);

        session()->flash('message', 'Billing Head Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function edit(int $billing_head_id)
    {
        $billingHead = BillingHead::find($billing_head_id);
        if ($billingHead) {
            $this->billing_head_id = $billing_head_id;
            $this->name = $billingHead->name;
        } else {
        }
    }

    public function update()
    {
        $validatedData = $this->validate();
        BillingHead::where('id', $this->billing_head_id)->update(['name' => $validatedData['name']]);
        session()->flash('message', 'Billing Head Edited Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $billing_head_id)
    {
        $this->billing_head_id = $billing_head_id;
    }

    public function destroy()
    {
        BillingHead::find($this->billing_head_id)->delete();
        session()->flash('message', 'Billing Head  delete Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal()
    {
        $this->reset();
    }

    public function resetInput()
    {
        $this->name = '';
    }

    public function render()
    {
        $billingHeads = BillingHead::orderBy('id', 'DESC')->get();
        return view('livewire.service.billing-head.billing-head-master', ['billingHeads' => $billingHeads])->extends('layouts.admin')->section('content');
    }
}

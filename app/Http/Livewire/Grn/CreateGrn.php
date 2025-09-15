<?php

namespace App\Http\Livewire\Grn;

use App\Models\Grn;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use Auth;
use Livewire\Component;

class CreateGrn extends Component
{

    public $vendors = [], $purchaseOrders = [];
    public $vendor_id, $purchase_order_id, $code, $invoice_no, $invoice_date, $invoice_value, $remarks;
    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->purchaseOrders = PurchaseOrder::all();
        $lastGrnId = Grn::max('id');
        $this->code = $this->getCode($lastGrnId);
    }
    protected function rules()
    {
        return [
            'vendor_id' => 'required',
            'purchase_order_id' => 'required',
            'code' => 'required',
            'invoice_no' => 'required',
            'invoice_date' => 'required',
            'invoice_value' => 'required'
        ];
    }
    public function save()
    {
        $this->validate();

        Grn::create([
            'vendor_id' => $this->vendor_id,
            'purchase_order_id' => $this->purchase_order_id,
            'code' => $this->code,
            'invoice_no' => $this->invoice_no,
            'invoice_date' => $this->invoice_date,
            'invoice_value' => $this->invoice_value,
            'remarks' => $this->remarks,
            'created_by_id' => Auth::user()?->id
        ]);

        session()->flash('message', 'GRN Added Successfully.');
        $this->reset();
        $this->dispatchBrowserEvent('close-modal');
    }
    protected function getCode($maxId)
    {
        $maxId = $maxId + 1;
        if ($maxId < 10)
            return 'GRN00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'GRN0' . $maxId;
        else if ($maxId >= 100)
            return 'GRN' . $maxId;
    }
    public function vendorChanged()
    {
        if ($this->vendor_id != -1) {
            $this->purchaseOrders = PurchaseOrder::where('vendor_id', $this->vendor_id)->get();
        }
    }
    public function render()
    {
        $grns = Grn::all();
        return view('livewire.grn.create-grn', ['grns' => $grns])->extends('layouts.admin')->section('content');
    }

    public function closeModal()
    {
        $this->reset();
        $this->vendors = Vendor::all();
        $this->purchaseOrders = PurchaseOrder::all();
    }
}

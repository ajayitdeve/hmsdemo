<?php

namespace App\Http\Livewire\Pharmacy\Vendor;

use \App\Models\Vendor;
use \App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class VendorRegistration extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $vendor_id, $code, $name, $legal_name, $cst_no, $drug_license_no, $drug_license_exp_date, $gst_no, $pan_no, $payment_days, $delivery_days, $type_id;
    public $vendors = [], $types = [];

    public function mount()
    {
        $this->vendors = Vendor::all();
        $this->types = Type::all();
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'legal_name' => 'required',
            // 'cst_no' => 'required',
            // 'drug_license_no' => 'required',
            // 'drug_license_exp_date' => 'required',
            'gst_no' => 'required',
            // 'pan_no' => 'required',
            'payment_days' => 'required',
            // 'delivery_days' => 'required',
            'type_id' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        Vendor::create([
            'code' => $this->generateVendorCode(),
            'name' => $this->name,
            'legal_name' => $this->legal_name,
            'cst_no' => $this->cst_no,
            'drug_license_no' => $this->drug_license_no,
            'drug_license_exp_date' => $this->drug_license_exp_date,
            'gst_no' => $this->gst_no,
            'pan_no' => $this->pan_no,
            'payment_days' => $this->payment_days,
            'delivery_days' => $this->delivery_days,
            'type_id' => $this->type_id
        ]);

        session()->flash('message', 'Vendor Added Successfully.');
        $this->reset([
            "vendor_id",
            "name",
            "code",
            "legal_name",
            "cst_no",
            "drug_license_no",
            "drug_license_exp_date",
            "gst_no",
            "pan_no",
            "payment_days",
            "delivery_days",
            "type_id"
        ]);

        $this->vendors = Vendor::all();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        return view('livewire.pharmacy.vendor.vendor-registration')->extends('layouts.admin')->section('content');
    }

    protected function generateVendorCode()
    {
        $maxId = Vendor::max('id');
        return 'MAN' . $maxId + 1;
    }

    public function closeModal()
    {
        $this->reset([
            "vendor_id",
            "name",
            "code",
            "legal_name",
            "cst_no",
            "drug_license_no",
            "drug_license_exp_date",
            "gst_no",
            "pan_no",
            "payment_days",
            "delivery_days",
            "type_id"
        ]);
    }

    public function edit(int $vendor_id)
    {
        $this->vendor_id = $vendor_id;
        $vendor = Vendor::find($vendor_id);
        if ($vendor) {
            $this->name = $vendor?->name;
            $this->legal_name = $vendor?->legal_name;
            $this->cst_no = $vendor?->cst_no;
            $this->drug_license_no = $vendor?->drug_license_no;
            $this->drug_license_exp_date = $vendor?->drug_license_exp_date;
            $this->gst_no = $vendor?->gst_no;
            $this->pan_no = $vendor?->pan_no;
            $this->payment_days = $vendor?->payment_days;
            $this->delivery_days = $vendor?->delivery_days;
            $this->type_id = $vendor?->type_id;
        } else {
        }
    }

    public function update()
    {
        $this->validate();

        Vendor::find($this->vendor_id)->update([
            'name' => $this->name,
            'legal_name' => $this->legal_name,
            'cst_no' => $this->cst_no,
            'drug_license_no' => $this->drug_license_no,
            'drug_license_exp_date' => $this->drug_license_exp_date,
            'gst_no' => $this->gst_no,
            'pan_no' => $this->pan_no,
            'payment_days' => $this->payment_days,
            'delivery_days' => $this->delivery_days,
            'type_id' => $this->type_id,
        ]);

        session()->flash('message', 'Vendor  Edited Successfully.');
        $this->reset([
            "vendor_id",
            "name",
            "code",
            "legal_name",
            "cst_no",
            "drug_license_no",
            "drug_license_exp_date",
            "gst_no",
            "pan_no",
            "payment_days",
            "delivery_days",
            "type_id"
        ]);

        $this->vendors = Vendor::all();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $vendor_id)
    {
        $this->vendor_id = $vendor_id;
    }

    public function destroy()
    {
        Vendor::where('id', $this->vendor_id)->delete();
        session()->flash('message', 'Vendor Deleted Successfully.');
        $this->reset([
            "vendor_id",
            "name",
            "code",
            "legal_name",
            "cst_no",
            "drug_license_no",
            "drug_license_exp_date",
            "gst_no",
            "pan_no",
            "payment_days",
            "delivery_days",
            "type_id"
        ]);

        $this->vendors = Vendor::all();
        $this->dispatchBrowserEvent('close-modal');
    }
}

<?php

namespace App\Http\Livewire\PurchaseIndent;

use Livewire\Component;

class AddPurchaseIndentItem extends Component
{
    public $purchase_indent_id, $client_id, $currency_id, $employee_id, $to, $clientaddress, $contactname, $description, $clientname, $hsn_id;
    public $companies = [], $employees = [], $clients = [], $currencies = [];
    public $quantity, $unit_price, $base_amount, $tax_amount, $other_amount, $total_amount, $desc;
    public $updateMode = false, $inputs = [], $i = 0, $total = 0, $totalTax = 0, $grandTotal = 0, $taxRate = 0.0;
    public $hsns = [];
    public function mount()
    {
        $this->reset();
        $this->companies = \App\Models\Company::all();
        $this->employees = Employee::all();
        $this->currencies = \App\Models\Currency::all();
        $this->clients = \App\Models\Client::all();
        $this->employees = [];
        $this->hsns = \App\Models\Hsn::all();
    }
    public function companyChanged()
    {
        if ($this->company_id != -1) {
            $this->employees = [];
            $this->employees = Employee::where('company_id', $this->company_id)->get();
            $currentCompany = \App\Models\Company::where('id', $this->company_id)->first();
            $this->taxRate = (float) $currentCompany->taxrate;
        }
    }
    public function clientChanged()
    {
        if ($this->client_id != -1) {
            $this->clientaddress = '';
            $current = \App\Models\Client::where('id', $this->client_id)->first();
            $this->clientaddress = $current->address;
            $this->to = $current->name;
        }
    }
    public function employeeChanged($rowId)
    {
        if ($this->employee_id != -1) {
            $this->employees[$rowId] = Employee::where('id', $this->employee_id[$rowId])->first();
            $this->unit_price[$rowId] = $this->employees[$rowId]->dayrate;
        }
    }
    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }
    public function remove($i, $val)
    {
        unset($this->inputs[$i]);
        //$description, $quantity, $unit_price, $base_amount, $tax_amount, $other_amount, $total_amount, $mou_id
        unset($this->desc[$val]);
        unset($this->quantity[$val]);
        unset($this->unit_price[$val]);
        unset($this->base_amount[$val]);
        unset($this->total_amount[$val]);
        unset($this->tax_amount[$val]);
        $this->calculateTotal();
    }
    protected $rules = [

        'quantity.0' => 'required',
        'quantity.*' => 'required',
        'company_id' => 'required',
        'client_id' => 'required',
        'to' => 'required',
        'clientaddress' => 'required',
        'contactname' => 'required',

    ];
    protected $messages = [

        'quantity.0.required' => 'Required',
        'quantity.*.required' => 'Required',

    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function store()
    {
        $this->validate();
        $lastInvoiceId = Invoice::max('id');
        //insert into invoice
        $invoice = Invoice::create([
            'invoice_number' => 'invoice' . $lastInvoiceId + 1,
            'type' => 'Service',
            'company_id' => $this->company_id,
            'client_id' => $this->client_id,
            'to' => $this->to,
            'clientname' => $this->clientname,
            'contactname' => $this->contactname,
            'description' => $this->description,
        ]);

        // dd($this->employee_id);
        $validatedDate = $this->validate();
        //for no hsn
        if ($this->company_id == 1) {
            foreach ((array) $this->unit_price as $key => $value) {
                AdminServiceInvoice::create([
                    'invoice_id' => $invoice->id,
                    'employee_id' => $this->employee_id[$key],
                    'hsn_id' => null,
                    'description' => $this->desc[$key],
                    'quantity' => $this->quantity[$key],
                    'unit_price' => $this->unit_price[$key],
                    'base_amount' => $this->base_amount[$key],
                    'tax_amount' => $this->tax_amount[$key],
                    'total_amount' => $this->total_amount[$key],

                ]);
            }
        }


        //for hsn
        if ($this->company_id == 2) {
            foreach ((array) $this->unit_price as $key => $value) {
                AdminServiceInvoice::create([
                    'invoice_id' => $invoice->id,
                    'employee_id' => $this->employee_id[$key],
                    'hsn_id' => $this->hsn_id[$key],
                    'description' => $this->desc[$key],
                    'quantity' => $this->quantity[$key],
                    'unit_price' => $this->unit_price[$key],
                    'base_amount' => $this->base_amount[$key],
                    'tax_amount' => $this->tax_amount[$key],
                    'total_amount' => $this->total_amount[$key],

                ]);
            }
        }

        $this->inputs = [];
        session()->flash('message', 'Invoice Created  Successfully.');
        $this->reset();
        //$this->resetExcept('employees') ;
        return redirect()->route('admin.invoice.create');
    }

    public function calculateTotal()
    {
        $total = 0;
        foreach ((array) $this->total_amount as $amount) {
            $total = $total + $amount;
        }
        $this->total = $total;
        //calculate total tax
        $tax = 0;
        foreach ((array) $this->tax_amount as $amount) {
            $tax = $tax + $amount;
        }
        $this->totalTax = $tax;
        //calculate GrandTotal
        $grandtotal = 0;
        $this->grandTotal = $this->total + $this->totalTax;
    }
    public function quantityIntoRate($id)
    {
        $baseAmount = 0;
        if (isset($this->quantity[$id]) && isset($this->unit_price[$id])) {
            $baseAmount = (float) $this->quantity[$id] * (float) $this->unit_price[$id];
        } else {
            $baseAmount = 0;
        }
        $tax = $baseAmount * ($this->taxRate / 100);
        $totalAmount = $baseAmount + $tax;
        $this->tax_amount[$id] = round($tax, 2);
        $this->total_amount[$id] = round($totalAmount, 2);
        $this->base_amount[$id] = round($baseAmount, 2);
        $this->base_amount[$id] = round($baseAmount, 2);
        $this->calculateTotal();
        $this->emit('VendorInvoice');
    }
    public function render()
    {
        return view('livewire.purchase-indent.add-purchase-indent-item')->extends('layouts.admin')->section('content');
    }
}

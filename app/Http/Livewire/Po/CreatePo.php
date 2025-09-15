<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;
use Auth;

class CreatePo extends Component
{

    //1- item_id 2- item_description 3- quantity 4-unitrate 5-igst 6- unitsalerate 7-bonus 8-discounted_amount 9-row_total
    public $purchase_order_id;
    public $purchaseterms, $discounted_amount, $igst, $row_total;
    public $purchase_indent_id; //route parameter receiving in mount
    public $item_id, $quantity, $unitrate, $unitsalerate, $bonus, $discount_percent, $row_unit_into_quantity;
    public $vendor_id;
    public $stock_point_id, $purchase_term_id, $code, $subtotal, $discount, $taxamount, $total, $status, $remarks, $created_by_id;
    public $item_description;

    public $stockponts = [], $items = [], $vendor = [], $types = [];
    public $updateMode = false, $inputs = [], $i = 0;
    public $recentIndents = [];
    public $stockpoints = [];
    public $vendors = [];
    public $recentPurchaseOrders = [];

    //for grand total
    public $gradSubTotal, $grandTotal, $grandTaxAmount, $grandDiscount;
    public function mount($purchase_indent_id)
    {
        $this->purchase_indent_id = $purchase_indent_id;
        $this->stockpoints = \App\Models\StockPoint::all();
        $this->items = \App\Models\Item::all();
        $this->purchaseterms = \App\Models\PurchaseTerm::all();
        $this->vendors = \App\Models\Vendor::all();
        $this->types = \App\Models\Type::all();
        $lastPoId = \App\Models\PurchaseOrder::max('id');
        $code = $this->indentCode($lastPoId);
        $this->code = $code;
        $this->status = false;
        //for recent indents
        $this->recentPurchaseOrders = \App\Models\PurchaseOrder::latest()->take(10)->orderBy('id', 'DESC')->get();
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
        //`item_id`, `quantity`, `unitrate`, `unitsalerate`, `bonus`, `discount_percent`,
        //1- item_id 2- item_description 3- quantity 4-unitrate 5-igst 6- unitsalerate 7-bonus 8-discounted_amount 9-row_total
        unset($this->item_id[$val]);
        unset($this->item_description[$val]);
        unset($this->quantity[$val]);
        unset($this->unitrate[$val]);
        unset($this->igst[$val]);
        unset($this->unitsalerate[$val]);
        unset($this->unitsalerate[$val]);
        unset($this->bonus[$val]);
        unset($this->discounted_amount[$val]);
        unset($this->row_total[$val]);
        unset($this->row_unit_into_quantity[$val]);
        $this->calculateTotal();
    }
    public function itemChanged($rowId)
    {

        if ($this->item_id != -1) {
            $selectedItem = \App\Models\Item::where('id', $this->item_id[$rowId])->first();
            // dd($selectedItem->code);
            if (isset($selectedItem)) {
                //first reset all fields
                $this->item_description[$rowId] = "";
                $this->quantity[$rowId] = "";
                $this->unitrate[$rowId] = "";
                $this->unitsalerate[$rowId] = "";
                $this->bonus[$rowId] = "";
                $this->igst[$rowId] = "";
                $this->discount_percent[$rowId] = 0;
                $this->discounted_amount[$rowId] = "";
                $this->row_total[$rowId] = "";

                //then set
                $this->item_description[$rowId] = $selectedItem->code;
                $this->igst[$rowId] = $selectedItem->igst;
            } else {
                $this->item_description[$rowId] = "";
                $this->quantity[$rowId] = "";
                $this->unitrate[$rowId] = "";
                $this->unitsalerate[$rowId] = "";
                $this->bonus[$rowId] = "";
                $this->igst[$rowId] = "";
                $this->discount_percent[$rowId] = 0;
                $this->discounted_amount[$rowId] = "";
                $this->row_total[$rowId] = "";
                $this->taxamount[$rowId] = "";
                $this->row_unit_into_quantity[$rowId] = "";
            }
        }
    }
    public function quantityChanged($rowId)
    {
        //quantity 10 and unit price Rs 50
        //check if quantity is not null
        if ($this->quantity[$rowId] != null) {
            $quantityIntoUnitRate = (int) $this->quantity[$rowId] * (float) $this->unitrate[$rowId];
            //10*50=500
            $discount = 0.0;
            $calDiscount = 0.0;
            //let discount is 5%
            if ($this->discount_percent[$rowId] != null) {
                $calDiscount = $this->discount_percent[$rowId] * (($quantityIntoUnitRate) / 100);
                //5*((50*10)/100)  now $calDiscount is rs 25
            }
            $discountedAmount = $quantityIntoUnitRate - $calDiscount;
            //500-25=475
            $taxAmount = number_format(($discountedAmount * (($this->igst[$rowId]) / 100)), 2);
            //let tax is 18 % then  475*(18/100)  ie 85.50
            $total = $discountedAmount + $taxAmount;
            //i.e 475 +85.50 = 560.50

            $this->row_total[$rowId] = $total;
            $this->discounted_amount[$rowId] = $calDiscount;
            $this->taxamount[$rowId] = $taxAmount;
            $this->row_unit_into_quantity[$rowId] = $quantityIntoUnitRate;
        }
        $this->gradSubTotal = $this->calSubTotal();
        $this->grandTotal = $this->calculateTotal();
        $this->grandTaxAmount = $this->calTaxAmount();
        $this->grandDiscount = $this->calculateDiscount();
    }

    public function unitrateChanged($rowId)
    {

        //quantity 10 and unit price Rs 50
        //check if quantity is not null
        if ($this->quantity[$rowId] != null) {
            $quantityIntoUnitRate = (int) $this->quantity[$rowId] * (float) $this->unitrate[$rowId];
            //10*50=500
            $discount = 0.0;
            $calDiscount = 0.0;
            //let discount is 5%
            if ($this->discount_percent[$rowId] != null) {
                $calDiscount = $this->discount_percent[$rowId] * (($quantityIntoUnitRate) / 100);
                //5*((50*10)/100)  now $calDiscount is rs 25
            }
            $discountedAmount = $quantityIntoUnitRate - $calDiscount;
            //500-25=475
            $taxAmount = $discountedAmount * (($this->igst[$rowId]) / 100);
            //let tax is 18 % then  475*(18/100)  ie 85.50
            $total = $discountedAmount + $taxAmount;
            //i.e 475 +85.50 = 560.50

            $this->row_total[$rowId] = $total;
            $this->discounted_amount[$rowId] = $calDiscount;
            $this->taxamount[$rowId] = $taxAmount;
            $this->row_unit_into_quantity[$rowId] = $quantityIntoUnitRate;
        }
        $this->gradSubTotal = $this->calSubTotal();
        $this->grandTotal = $this->calculateTotal();
        $this->grandTaxAmount = $this->calTaxAmount();
        $this->grandDiscount = $this->calculateDiscount();
    }
    public function discountPercentChanged($rowId)
    {
        if ($this->discount_percent[$rowId] != null) {
            $this->unitrateChanged($rowId);
        }
    }

    public function quantityintorate($rowId)
    {
        return $this->quantity[$rowId] * (float) $this->unitrate[$rowId];;
    }

    public function calSubTotal()
    {
        $subTotal = 0;
        foreach ((array) $this->row_unit_into_quantity as $amount) {
            $subTotal = $subTotal + $amount;
        }
        return $subTotal;
    }

    public function calTaxAmount()
    {

        $total = 0;
        foreach ((array) $this->taxamount as $amount) {
            $total = $total + $amount;
        }
        return $total;
    }
    public function calculateTotal()
    {
        $total = 0;
        foreach ((array) $this->row_total as $amount) {
            $total = $total + $amount;
        }
        return $total;
    }
    public function calculateDiscount()
    {
        $total = 0;
        foreach ((array) $this->discounted_amount as $amount) {
            $total = $total + $amount;
        }
        return $total;
    }
    public function updated($propertyName)
    {
        //  $this->validateOnly($propertyName);
    }
    protected $rules = [
        //`purchase_term_id`, `purchase_indent_id`, `code`, `subtotal`, `discount`, `taxamount`, `total`, `status`, `remarks`, `created_by_id`,
        'stock_point_id' => 'required',
        'vendor_id' => 'required',
        'purchase_indent_id' => 'required',
        // 'request_date' => 'required',
        // 'status' => 'required',
        // 'remarks' => 'required',
    ];
    public function store()
    {
        // `vendor_id`, `stock_point_id`, `purchase_term_id`, `purchase_indent_id`, `code`, `subtotal`, `discount`, `taxamount`, `total`, `status`, `remarks`,
        //`id`, `purchase_indent_id`, `item_id`, `quantity`, `unitrate`, `unitsalerate`, `bonus`, `discount_percent`,
        //  $this->validate();

        //insert into purchase_orders table
        $purchase_order_id = \App\Models\PurchaseOrder::create([
            'vendor_id' => $this->vendor_id,
            'stock_point_id' => $this->stock_point_id,
            'purchase_term_id' => $this->purchase_term_id,
            'purchase_indent_id' => $this->purchase_indent_id,
            'code' => $this->code,
            // 'subtotal' => $this->gradSubTotal,
            // 'discount' => $this->grandDiscount,
            // 'total' => $this->grandTotal,
            // 'status' => false,
            'remarks' => $this->remarks,
            'created_by_id' => Auth::user()?->id,
            'taxamount' => $this->grandTaxAmount

        ]);

        $this->purchase_order_id = $purchase_order_id->id;
        //dd($purchase_indent_id->id);
        //  $validated= $this->validate();

        foreach ((array) $this->item_id as $key => $value) {
            \App\Models\PurchaseOrderItem::create([
                'purchase_order_id' => $this->purchase_order_id,
                'item_id' => $this->item_id[$key],
                'quantity' => $this->quantity[$key] ?: 1,
                'unitrate' => $this->unitrate[$key] ?: 0,
                'unitsalerate' => $this->unitsalerate[$key] ?: 0,
                'bonus' => $this->bonus[$key] != null ? $this->bonus[$key] : 0,
                'discount_percent' => $this->discount_percent[$key] ?: 0,
            ]);
        }
        // dd('hi');
        $this->inputs = [];
        session()->flash('message', 'Indent Created  Successfully.');
        //$this->reset();
        //$this->resetExcept('employees') ;
        return redirect()->route('admin.po.create-purchase-indent');
    }
    protected function indentCode($maxId)
    {
        $maxId = $maxId + 1;
        if ($maxId < 10)
            return 'PO00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'PO0' . $maxId;
        else if ($maxId >= 100)
            return 'PO' . $maxId;
    }
    public function render()
    {
        return view('livewire.po.create-po')->extends('layouts.admin')->section('content');
    }
}

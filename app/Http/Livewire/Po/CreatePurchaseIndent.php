<?php

namespace App\Http\Livewire\Po;

use Livewire\Component;

class CreatePurchaseIndent extends Component
{

    public $stock_point_id, $vendor_id, $type_id, $code, $date, $request_date, $status, $remarks;
    public $item_description;
    public $purchase_indent_id, $item_id, $quantity;
    public $stockponts = [], $items = [], $vendor = [], $types = [];
    public $updateMode = false, $inputs = [], $i = 0, $total = 0;
    //for all indens
    public $recentIndents = [];
    public function mount()
    {
        $this->reset();
        $this->stockpoints = \App\Models\StockPoint::all();
        $this->items = \App\Models\Item::all();
        $this->vendors = \App\Models\Vendor::all();
        $this->types = \App\Models\Type::all();
        $lastIndentId = \App\Models\PurchaseIndent::max('id');
        $code = $this->indentCode($lastIndentId);
        $this->code = $code;
        $this->status = false;
        //for recent indents
        $this->recentIndents = \App\Models\PurchaseIndent::latest()->take(10)->orderBy('id', 'DESC')->get();
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
        unset($this->stock_point_id[$val]);
        unset($this->quantity[$val]);
        $this->calculateTotal();
    }
    public function itemChanged($rowId)
    {

        if ($this->item_id != -1) {
            $selectedItem = \App\Models\Item::where('id', $this->item_id[$rowId])->first();
            // dd($selectedItem->code);
            if (isset($selectedItem)) {
                $this->item_description[$rowId] = $selectedItem->code;
            } else {
                $this->item_description[$rowId] = "";
            }
        }
    }
    public function calculateTotal()
    {
        $total = 0;
        foreach ((array) $this->quantity as $quantity) {
            $total = $total + $quantity;
        }
        $this->total = $total;
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected $rules = [
        'stock_point_id' => 'required',
        'vendor_id' => 'required',
        'type_id' => 'required',
        'request_date' => 'required',
        'status' => 'required',
        'remarks' => 'required',
    ];
    public function store()
    {
        $this->validate();

        //insert into Purchaseindent
        $purchase_indent_id = \App\Models\PurchaseIndent::create([
            'code' => $this->code,
            'stock_point_id' => $this->stock_point_id,
            'vendor_id' => $this->vendor_id,
            'type_id' => $this->type_id,
            'request_date' => $this->request_date,
            'date' => \Carbon\Carbon::now(),
            'status' => 0,
            'remarks' => $this->remarks,
        ]);

        $this->purchase_indent_id = $purchase_indent_id->id;
        //dd($purchase_indent_id->id);
        //$validated= $this->validate();

        foreach ((array) $this->item_id as $key => $value) {
            \App\Models\IndentItem::create([
                'purchase_indent_id' => $purchase_indent_id->id,
                'item_id' => $this->item_id[$key],
                'quantity' => $this->quantity[$key],
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
        if ($maxId < 10)
            return 'PI00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'PI0' . $maxId;
        else if ($maxId >= 100)
            return 'PI' . $maxId;
    }
    public function render()
    {
        return view('livewire.po.create-purchase-indent')->extends('layouts.admin')->section('content');
    }
}

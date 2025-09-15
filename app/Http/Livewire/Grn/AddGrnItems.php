<?php

namespace App\Http\Livewire\Grn;

use Carbon\Carbon;
use App\Models\Grn;
use App\Models\Rate;
use Livewire\Component;

use App\Models\PurchaseOrderItem;
use Illuminate\Support\Facades\Auth;

class AddGrnItems extends Component
{
    public $grn_id, $item_id, $batch_no, $mfd, $exd, $quantity, $purchase_rate, $bonus = 0, $mrp, $discount = 0, $tax, $hsncode;
    public $items = [], $inventories = [];
    public $purchase_order, $quantityInPo, $quantityError = '';

    //--NEW Variables
    public $arrCart = [], $counter = 0, $grn, $item;

    public $cartTotal = 0, $cartDiscount = 0, $cartTax = 0;
    public function mount($grn_id)
    {
        $this->grn_id = $grn_id;
        //show only those items who are listed in Purchase order
        //get  grn
        $grn = Grn::find($this->grn_id);
        $this->grn = $grn;
        //get purchase_order_id for grn
        $purchase_order_id = $grn->purchaseOrder->id;
        //get all item_id for purchase order and convert into array
        $purchaseOrderItems = PurchaseOrderItem::where('purchase_order_id', $purchase_order_id)->pluck('item_id')->toArray();
        //get all items who are in po
        $this->items = \App\Models\Item::whereIn('id', array_unique($purchaseOrderItems))->get();
        // dd($this->items);
        $this->inventories = \App\Models\Inventory::where('grn_id', $this->grn_id)->get();
        //getting PurchaseOrder for the current grn
        $this->purchase_order = $grn->purchaseOrder->first();
        // dd($this->purchase_order->purchaseOrderItems);

    }
    public function fetchInventory()
    {
        $this->inventories = \App\Models\Inventory::where('grn_id', $this->grn_id)->get();
    }
    protected function rules()
    {
        return [
            'item_id' => 'required',
            'batch_no' => 'required',
            // 'mfd'=>'required',
            'exd' => 'required',
            'quantity' => 'required',
            'purchase_rate' => 'required',
            'bonus' => 'required',
            'mrp' => 'required',
            'discount' => 'required',
            'tax' => 'required',
            'hsncode' => 'required',
        ];
    }
    public function save()
    {

        //$validatedData=$this->validate();
        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp['grn_id'] = $item['grn_id'];
            $temp['item_id'] = $item['item_id'];
            $temp['batch_no'] = $item['batch_no'];
            $temp['mfd'] = $item['mfd'];
            $temp['exd'] = $item['exd'];
            $temp['quantity'] = $item['quantity'];
            $temp['purchase_rate'] = $item['purchase_rate'];
            $temp['bonus'] = $item['bonus'];
            $temp['mrp'] = $item['mrp'];
            $temp['discount'] = $item['discount'];
            $temp['tax'] = $item['tax'];
            $temp['hsncode'] = $item['hsncode'];
            $temp['created_at'] = Carbon::now();
            $temp['updated_at'] = Carbon::now();
            array_push($data, $temp);
        }
        \App\Models\Inventory::insert($data);


        //add in rates table
        //'item_id', 'batch_no', 'current_purchase_rate', 'current_sale_rate', 'new_purchase_rate', 'new_sale_rate', 'doc', 'status', 'approved_by_id', 'remarks'
        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];


            $temp['item_id'] = $item['item_id'];
            $temp['batch_no'] = $item['batch_no'];
            $temp['current_purchase_rate'] = $item['purchase_rate'];
            $temp['current_sale_rate'] = $item['mrp'];
            $temp['new_purchase_rate'] = 0.0;
            $temp['new_sale_rate'] = 0.0;
            $temp['doc'] = Carbon::now();
            $temp['status'] = false;
            $temp['approved_by_id'] = Auth::user()?->id;
            $temp['remarks'] = 'Inital Entry';
            $temp['created_at'] = Carbon::now();
            $temp['updated_at'] = Carbon::now();
            array_push($data, $temp);
        }
        Rate::insert($data);
        session()->flash('message', 'GRN Added Successfully.');
        $this->reset('item_id', 'batch_no', 'mfd', 'exd', 'quantity', 'purchase_rate', 'bonus', 'mrp', 'discount', 'tax', 'hsncode');
        $this->fetchInventory();
    }

    public function itemChanged()
    {
        if ($this->item_id != -1) {
            $item = \App\Models\Item::find($this->item_id);
            $this->item = $item;
            $this->tax = $item->cgst + $item->sgst;
            $this->hsncode = $item->hsn;
            //getting the quantity for an item in purchase order
            $this->quantityInPo = $this->purchase_order->purchaseOrderItems->where('item_id', $this->item_id)->first();
        }
    }
    public function quantityChanged()
    {
        if ($this->item_id != -1 && $this->quantity != null) {
            if ($this->quantity > $this->quantityInPo->quantity) {
                $this->quantityError = "Quantity in PO is " . $this->quantityInPo->quantity;
            } else {
                $this->quantityError = "";
            }
        }
    }
    public function render()
    {
        $grn = Grn::find($this->grn_id);
        return view('livewire.grn.add-grn-items', ['grn' => $grn])->extends('layouts.admin')->section('content');
    }

    public function addToCart()
    {
        $this->validate();
        $this->counter++;
        $cart = new \App\Services\GrnItemCart($this->counter, $this->grn_id, $this->grn->code, $this->item_id, $this->item->code, $this->item->description, $this->batch_no, $this->mfd, $this->exd, $this->quantity, $this->purchase_rate, $this->bonus, $this->mrp, $this->discount, $this->tax, $this->hsncode);
        $temp = [];
        $temp['id'] = $cart->id;
        $temp['grn_id'] = $cart->grn_id;
        $temp['grn_code'] = $cart->grn_code;
        $temp['item_id'] = $cart->item_id;
        $temp['item_code'] = $cart->item_code;
        $temp['item_description'] = $cart->item_description;
        $temp['batch_no'] = $cart->batch_no;
        $temp['mfd'] = $cart->mfd;
        $temp['exd'] = $cart->exd;
        $temp['quantity'] = $cart->quantity;
        $temp['purchase_rate'] = $cart->purchase_rate;
        $temp['bonus'] = $cart->bonus;
        $temp['mrp'] = $cart->mrp;
        $temp['discount'] = $cart->discount;
        $temp['tax'] = $cart->tax;
        $temp['hsncode'] = $cart->hsncode;
        array_push($this->arrCart, $temp);
        $this->calCartTotal();
        //save in session
        session()->put('cart-data', $this->arrCart);
        //reseting form
        $this->reset('item_id', 'batch_no', 'mfd', 'exd', 'quantity', 'purchase_rate', 'bonus', 'mrp', 'discount', 'tax', 'hsncode');
    }
    public function editCart($id)
    {

        unset($this->arrCart[$id - 1]);
        session()->forget('cart-data');
        $this->calCartTotal();
        session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Item Removed Successfully.');
    }

    public function calCartTotal()
    {
        $sum = 0;
        $sumDiscount = 0;
        $sumTax = 0;

        foreach ($this->arrCart as $cart) {
            $tempSum = $cart['purchase_rate'] * $cart['quantity'];
            $sum = $sum + $tempSum;

            $sumDiscount = $sumDiscount + $cart['discount'];

            $tempTax = ($tempSum * ($cart['tax'])) / 100;

            $sumTax = $sumTax + $tempTax;
        }
        $this->cartTotal = $sum;
        $this->cartDiscount = $sumDiscount;
        $this->cartTax = $sumTax;
    }
}

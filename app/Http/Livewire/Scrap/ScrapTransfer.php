<?php

namespace App\Http\Livewire\Scrap;

use App\Models\User;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\SaleStore;
use App\Models\StockPoint;
use App\Models\RoleStockPoint;
use App\Traits\ManageMedicineStock;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;

class ScrapTransfer extends Component
{
    use ManageMedicineStock, PharmacyStockPoint;

    public  $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $registration_no, $umr, $batch_nos = [], $counter, $arrCart = [];
    public $patientVisit, $patient;

    public $items = [];
    public $stock_point_id, $exd;
    public $stockPoint;
    public $discountAmount = 0, $discount_approved_by_id = 1, $users = [];
    //$discount is % discount and when user edit  $discountAmount , $dicount (i.e. discount in %) will be automatically  calculated
    public $payableAmount = 0, $payingAmount = 0, $dueAmount = 0;
    public $due_approved_by_id = 1;
    //pharmacyDue
    public $pharmacyDue = null, $prviousDuesAmount = 0;

    public $balanceAgainstCash, $cashAmount;
    //new code for scrap transfer
    public $scrap_remarks, $stock_point_to_id, $scrap_transfer_date, $scrapTypes = [];
    public $item_id, $grn_id, $scrap_type_id = 1, $batch_no, $quantity, $unit_sale_price, $unit_purchase_price, $remarks, $created_by_id, $updated_by_id;
    public $sumSaleRate = 0, $sumPurchaseRate = 0, $item_code, $item_description;
    public function mount()
    {
        $this->checkStockPointSession();

        $this->batch_nos = null;
        $this->counter = 0;

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stockPoint = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;
        //all users
        $this->users = User::all();
        $this->stockPoints = StockPoint::where('id', '!=', $this->stock_point_id)->get();
        //get the item which is available in sale_sores for give sales_store
        $saleStoreItems = SaleStore::where('stock_point_id', $this->stock_point_id)->pluck('item_id')->toArray();
        $saleStoreItems = array_unique($saleStoreItems);
        $this->items = \App\Models\Item::whereIn('id', $saleStoreItems)->get();
        $this->scrapTypes = \App\Models\ScrapType::all();
    }


    public function itemChanged()
    {

        $item = \App\Models\Item::where('id', $this->item_id)->first();
        //first: check item is exist in SaleStores table for given stock_point id
        $isItemExist = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item->id)->where('received', 1)->count();
        if ($isItemExist) {
            $rate = $item->rates->where('status', 0)->first();
            $this->unit_sale_price = $rate->current_sale_rate;
            $this->unit_purchase_price = $rate->current_purchase_rate;
            $avlQty = $this->availableQuantityByItem($this->item_id);
            $this->batch_nos = null;
            $this->batch_nos = collect($avlQty);
            $this->batch_no = $avlQty[0]['batch_no'];
            $this->cgst = $item->cgst;
            $this->sgst = $item->sgst;
            //additional fields
            $this->item_code = $item->code;
            $this->item_description = $item->description;
        }
    }

    public function batchNoChanged($batch_no)
    {

        $this->batch_no = $batch_no;
    }
    public function quantityChanged()
    {

        $this->discount = 0;
        $this->discountAmount = 0;
        $this->amount = $this->quantity * $this->unit_sale_price;
        $this->taxable_amount = $this->amount - $this->calDiscount();
        $this->calTotal();
        //getting expiry date
        $this->exd = Inventory::where('batch_no', $this->batch_no)->first('exd')->exd;
    }
    public function calDiscount()
    {
        if ($this->discount != null) {
            return $this->amount * $this->discount / 100;
        } else {
            return 0;
        }
    }
    public function discountChanged()
    {
        $this->taxable_amount = $this->amount - $this->calDiscount();
        //setting $discountAmount
        if ($this->discount != null) {
            $this->discountAmount = $this->amount * $this->discount / 100;
        } else {
            $this->discountAmount = 0;
        }
        $this->calTotal();
    }

    public function discountAmountChanged()
    {
        //setting $discountAmount
        $tempDiscountPercent = ($this->discountAmount * 100) / $this->amount;
        $this->discount = $tempDiscountPercent;
        $this->taxable_amount = $this->amount - $this->calDiscount();
        $this->calTotal();
    }
    public function calTotal()
    {
        $this->total = $this->taxable_amount + ($this->taxable_amount * ($this->cgst + $this->sgst) / 100);
    }

    protected $rules = [

        'item_id' => 'required',
        'batch_no' => 'required',
        'quantity' => 'required',
        'unit_sale_price' => 'required',
        'amount' => 'required',
        // 'discount' => 'required',
        // 'taxable_amount' => 'required',
        // 'cgst' => 'required',
        // 'sgst' => 'required',
        // 'total' => 'required'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addToCart()
    {
        $this->validate();

        $is_stock = $this->check_available_stock();

        if ($is_stock) {
            session()->flash('error', 'Medicine stock not available.');
            return;
        }

        $this->counter++;
        //getting grn_id
        $this->grn_id = $this->getGrnId($this->item_id, $this->batch_no);

        $cart = new \App\Services\ScrapTransferCart($this->counter, $this->item_id, $this->item_code, $this->item_description, $this->grn_id, $this->scrap_type_id, $this->batch_no, $this->quantity, $this->unit_sale_price, $this->unit_purchase_price, $this->remarks, $this->created_by_id, $this->updated_by_id);
        $temp = [];
        $temp['id'] = $cart->id;
        $temp['item_id'] = $cart->item_id;
        $temp['item_code'] = $cart->item_code;
        $temp['item_description'] = $cart->item_description;
        $temp['grn_id'] = $cart->grn_id;
        $temp['scrap_type_id'] = $cart->scrap_type_id;
        $temp['batch_no'] = $cart->batch_no;
        $temp['quantity'] = $cart->quantity;
        $temp['unit_sale_price'] = $cart->unit_sale_price;
        $temp['unit_purchase_price'] = $cart->unit_purchase_price;
        $temp['remarks'] = $cart->remarks;
        $temp['created_by_id'] = $cart->created_by_id;
        $temp['updated_by_id'] = $cart->updated_by_id;

        array_push($this->arrCart, $temp);
        //save in session
        session()->put('cart-data', $this->arrCart);
        $this->calculatePayble();
        //reseting form
        $this->reset('id', 'item_id', 'grn_id', 'scrap_type_id', 'batch_no', 'quantity', 'unit_sale_price', 'unit_purchase_price', 'remarks', 'created_by_id', 'updated_by_id', 'amount', 'exd', 'taxable_amount', 'sgst', 'cgst');
    }

    public function editCart($id)
    {
        // dd($this->arrCart);
        // $this->arrCart=array_slice($this->arrCart,1);
        unset($this->arrCart[$id - 1]);
        //    array_splice($this->arrCart, $id-1, 1);
        //  dd($this->arrCart);

        session()->forget('cart-data');
        session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Item Removed Successfully.');
    }


    public function calculatePayble()
    {
        $sumSaleRate = 0;
        $sumPurchaseRate = 0;
        foreach ($this->arrCart as $item) {
            $sumPurchaseRate = $sumPurchaseRate + ($item['quantity'] * $item['unit_purchase_price']);
            $sumSaleRate = $sumSaleRate + ($item['quantity'] * $item['unit_sale_price']);
        }
        $this->sumSaleRate = $sumSaleRate;
        $this->sumPurchaseRate = $sumPurchaseRate;
    }

    public function payingAmountChanged()
    {
        // dd("Paying Amount Changed");
        $this->dueAmount = $this->sumSaleRate - $this->payingAmount;
    }
    public function save()
    {
        //dd($this->arrCart);
        //first insert in Scraps table
        //'stock_point_from_id','stock_point_to_id','remarks','scrap_transfer_date','status','created_by_id','updated_by_id','approved_by_id'
        $maxId = \App\Models\Scrap::max('id');
        $scrap_id = \App\Models\Scrap::create([
            'stock_point_from_id' => $this->stock_point_id,
            'stock_point_to_id' => $this->stock_point_to_id,
            'code' => 'SCN' . $maxId + 1,
            'remarks' => $this->scrap_remarks,
            'scrap_transfer_date' => date('Y-m-d H:i:s'),
            'status' => false,
            'created_by_id' => Auth::user()?->id,
            'updated_by_id' => Auth::user()?->id,
            'approved_by_id' => null,
        ]);
        //'scrap_id','item_id','grn_id','scrap_type_id','batch_no','quantity','unit_sale_price','unit_purchase_price',
        //'remarks','created_by_id','updated_by_id'
        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp['scrap_id'] = $scrap_id->id;
            $temp['item_id'] = $item['item_id'];
            $temp['scrap_type_id'] = $item['scrap_type_id'];
            $temp['batch_no'] = $item['batch_no'];
            $temp['grn_id'] = $item['grn_id'];
            $temp['quantity'] = $item['quantity'];
            $temp['unit_sale_price'] = $item['unit_sale_price'];
            $temp['unit_purchase_price'] = $item['unit_purchase_price'];
            $temp['remarks'] = $item['remarks'];
            $temp['created_by_id'] = $item['created_by_id'];
            $temp['updated_by_id'] = $item['updated_by_id'];
            array_push($data, $temp);
        }
        \App\Models\ScrapItem::insert($data);

        //dd('scrap Created');

        return redirect()->route('admin.pharmacy.scrap.list-scrap')->with('message', 'Scrap Transfer Done');
    }

    public function cashAmountChanged()
    {
        // dd($this->cashAmount);
        if ($this->cashAmount != 0) {
            $this->balanceAgainstCash = $this->cashAmount - $this->payableAmount;
        }
    }
    public function getGrnId($itemId, $batchNo)
    {
        $grn = Inventory::where('item_id', $itemId)->where('batch_no', $batchNo)->first()->grn;
        return $grn->id;
    }
    public function render()
    {

        return view('livewire.scrap.scrap-transfer')->extends('layouts.admin')->section('content');
    }
}

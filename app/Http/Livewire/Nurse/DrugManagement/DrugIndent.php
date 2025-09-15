<?php

namespace App\Http\Livewire\Nurse\DrugManagement;

use App\Models\IpPharmacyIndent;
use App\Models\IpPharmacyIndentItem;
use App\Models\Inventory;
use App\Models\Ipd\Ipd;
use App\Models\Item;
use App\Models\SaleStore;
use App\Models\StockPoint;
use App\Models\User;
use App\Services\IpPharmacyIndentCart;
use App\Traits\ManageMedicineStock;
use App\Traits\NurseDepartment;
use Livewire\Component;

class DrugIndent extends Component
{
    use NurseDepartment, ManageMedicineStock;

    public $ipd, $ipd_code, $bg_color, $exd;
    public $nrq_no, $nrq_date, $req_by, $status, $admn_no, $admn_date, $ward, $room, $bed, $umr, $patient_name, $nurse_department_code, $nurse_department_name;
    public $doctor_code, $doctor_name, $stock_point_id, $stock_point_code, $corporate_name, $patient_type, $doctor_department_code, $doctor_department_name, $remarks;
    public $stock_points = [];

    public $batch_no, $quantity, $unit_sale_price, $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $item_id, $item_name;
    public $items = [], $counter, $arrCart = [], $batch_nos = [], $users = [];
    public $discount_approved_by_id = 1, $payableAmount = 0, $dueAmount = 0, $payingAmount = 0, $discountAmount = 0, $prviousDuesAmount = 0;

    protected $rules = [
        'nrq_no' => 'required',
        'nrq_date' => 'required',
        'admn_no' => 'required',
        'admn_date' => 'required',
        'umr' => 'required',
        'doctor_code' => 'required',
        'doctor_name' => 'required',
        'stock_point_id' => 'required',
        'arrCart' => 'required|array',
    ];

    protected $messages = [
        'arrCart.required' => 'Please add at least one item.',
    ];

    protected function generateNrqNo()
    {
        $count = IpPharmacyIndent::max("id");
        return "NRQ" . date('y') . date('m') . date('d') . ($count + 1);
    }

    public function mount($ipd_code)
    {
        $this->checkNurseStationSession();

        $this->batch_nos = null;
        $this->ipd_code = $ipd_code;
        $this->stock_points = StockPoint::where("id", "!=", 1)->get();
        $this->items = Item::get();
        $this->users = User::all();

        $ipd = Ipd::with(
            [
                "bed",
                "room" => function ($query) {
                    $query->where("nurse_station_id", session()->get("nurse_station_id"));
                },
                "patient_visit" => function ($query) {
                    $query->with(['doctor']);
                },
                "patient" => function ($query) {
                    $query->with(['gender']);
                }
            ]
        )
            ->whereHas("room", function ($query) {
                $query->where("nurse_station_id", session()->get("nurse_station_id"));
            })
            ->where("ipdcode", $this->ipd_code)
            ->first();

        if ($ipd) {
            $this->ipd = $ipd;

            $this->nrq_no = $this->generateNrqNo();
            $this->nrq_date = date("Y-m-d");
            $this->req_by = auth()->user()->name;
            $this->status = "Not Approved";
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->ward = $ipd->ward?->name;
            $this->room = $ipd->room?->name;
            $this->bed = $ipd->bed?->display_name;
            $this->umr = $ipd->patient?->registration_no;
            $this->patient_name = $ipd->patient?->name;
            $this->nurse_department_code = $ipd->room?->nurseStation?->code;
            $this->nurse_department_name = $ipd->room?->nurseStation?->name;

            $this->doctor_code = $ipd->patient_visit?->doctor?->code;
            $this->doctor_name = $ipd->patient_visit?->doctor?->name;
            $this->patient_type = $ipd->patient?->patienttype->name;
            $this->doctor_department_code = $ipd->patient_visit?->department?->code;
            $this->doctor_department_name = $ipd->patient_visit?->department?->name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;
        }
    }

    public function stockPointChanged()
    {
        $stock_point = StockPoint::where('id', $this->stock_point_id)->first();

        if ($stock_point) {
            $this->stock_point_code = $stock_point->code;
            $this->reset('item_id', 'item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');
        } else {
            $this->reset('item_id', 'item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');
        }
    }

    public function itemChanged()
    {
        $this->validate([
            "stock_point_id" => "required"
        ]);

        $this->reset('item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');

        $item = \App\Models\Item::where('id', $this->item_id)->first();
        //first: check item is exist in SaleStores table for given stock_point id

        $isItemExist = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item->id)->where('received', 1)->count();
        if ($isItemExist) {
            $this->item_name = $item->description;

            $rate = $item->rates->where('status', 0)->first();
            $this->unit_sale_price = $rate->current_sale_rate;
            $avlQty = $this->availableQuantityByItem($this->item_id);
            $this->batch_nos = null;
            $this->batch_nos = collect($avlQty);
            $this->batch_no = $avlQty[0]['batch_no'];
            $this->cgst = $item->cgst;
            $this->sgst = $item->sgst;

            if ($item?->sale_rate_for_billing_used_for == 'ip' || $item?->sale_rate_for_billing_used_for == 'both') {
                $this->discount = $item?->sale_rate_for_billing_percentage;
                $this->discountAmount = $item?->sale_rate_for_billing_amount;
            }
        }

        // dd(collect($avlQty));
    }

    public function batchNoChanged($batch_no)
    {
        $this->batch_no = $batch_no;
    }

    public function quantityChanged()
    {

        $this->validate([
            "quantity" => "required|integer|min:1",
            "stock_point_id" => "required",
        ]);

        // $this->discount = 0;
        // $this->discountAmount = 0;
        $this->amount = $this->quantity * $this->unit_sale_price;


        if ($this->discount != null && $this->discount > 0) {
            $this->discountChanged();
        } else if ($this->discountAmount != null && $this->discountAmount > 0) {
            $this->discountAmountChanged();
        } else {
            $this->taxable_amount = $this->amount - $this->calDiscount();
            $this->calTotal();
        }

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
        $this->validate([
            'discount' => 'required|numeric|min:0|max:100',
        ]);

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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function addToCart()
    {
        $this->validate([
            'nrq_no' => 'required',
            'nrq_date' => 'required',
            'admn_no' => 'required',
            'admn_date' => 'required',
            'umr' => 'required',
            'stock_point_id' => 'required',
            'item_id' => 'required',
            "quantity" => "required|integer|min:1",
            // 'unit_sale_price' => 'required',
            // 'amount' => 'required',
            // 'exd' => 'required',
            // 'discount' => 'required|numeric|min:0|max:100',
            // 'total' => 'required',
            'payingAmount' => 'required|min:0',
        ]);

        $is_stock = $this->check_available_stock();

        if ($is_stock) {
            session()->flash('error', 'Medicine stock not available.');
            return;
        }

        $this->counter++;
        $cart = new IpPharmacyIndentCart($this->counter, $this->item_id, $this->item_name, $this->stock_point_id, $this->batch_no, $this->exd, $this->quantity, $this->unit_sale_price, $this->amount, $this->discount, $this->taxable_amount, $this->cgst, $this->sgst, $this->total, $this->discount_approved_by_id);
        $temp = [];

        $temp['id'] = $cart->id;
        $temp['item_id'] = $cart->item_id;
        $temp['item_name'] = $cart->item_name;
        $temp['stock_point_id'] = $cart->stock_point_id;
        $temp['batch_no'] = $cart->batch_no;
        $temp['exd'] = $cart->exd;
        $temp['quantity'] = $cart->quantity;
        $temp['unit_sale_price'] = $cart->unit_sale_price;
        $temp['amount'] = $cart->amount;
        $temp['discount'] = $cart->discount;
        $temp['taxable_amount'] = $cart->taxable_amount;
        $temp['cgst'] = $cart->cgst;
        $temp['sgst'] = $cart->sgst;
        $temp['total'] = $cart->total;
        $temp['discount_approved_by_id'] = $cart->discount_approved_by_id;

        array_push($this->arrCart, $temp);

        $this->calculatePayble();
        //reseting form
        $this->reset('item_id', 'item_name', 'batch_no', 'exd', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');
    }

    public function editCart($id)
    {
        // dd($this->arrCart);
        // $this->arrCart=array_slice($this->arrCart,1);
        unset($this->arrCart[$id - 1]);
        //    array_splice($this->arrCart, $id-1, 1);
        //  dd($this->arrCart);

        $this->calculatePayble();

        session()->forget('cart-data');
        session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Item Removed Successfully.');
    }

    public function calculatePayble()
    {
        $sum = 0;
        foreach ($this->arrCart as $item) {
            $sum = $sum + $item['total'];
        }
        $this->payableAmount = $sum + $this->prviousDuesAmount;
        $this->payingAmount = $sum + $this->prviousDuesAmount;;
    }

    public function payingAmountChanged()
    {
        $this->validate([
            'payingAmount' => 'required|min:0',
        ]);

        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }

    public function save()
    {
        $this->validate();

        $ip_pharmacy_indent = IpPharmacyIndent::create([
            'ipd_id' => $this->ipd->id,
            'patient_id' => $this->ipd->patient_id,
            'stock_point_id' => $this->stock_point_id,
            'nrq_code' => $this->generateNrqNo(),
            'remarks' => $this->remarks,
            'status' => "Not Approved",
            'nurse_station_id' => session()->get('nurse_station_id'),
            'created_by_id' => auth()->user()?->id,
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp['ip_pharmacy_indent_id'] = $ip_pharmacy_indent->id;
            $temp['item_id'] = $item['item_id'];
            $temp['stock_point_id'] = $item['stock_point_id'];
            $temp['batch_no'] = $item['batch_no'];
            $temp['exd'] = date("Y-m-d", strtotime($item['exd']));
            $temp['quantity'] = $item['quantity'];
            $temp['unit_sale_price'] = $item['unit_sale_price'];
            $temp['amount'] = $item['amount'];
            $temp['discount'] = ($item['amount'] * $item['discount']) / 100;
            $temp['taxable_amount'] = $item['taxable_amount'];
            $temp['cgst'] = $item['cgst'];
            $temp['sgst'] = $item['sgst'];
            $temp['total'] = $item['total'];
            $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');

            array_push($data, $temp);
        }

        IpPharmacyIndentItem::insert($data);

        session()->flash("nrq_no", $ip_pharmacy_indent->nrq_code);
        $this->dispatchBrowserEvent('open-nrq-no-modal');

        session()->flash("success", "Indent Saved Successfully");
    }

    public function render()
    {
        return view('livewire.nurse.drug-management.drug-indent')->extends('layouts.admin')->section('content');
    }
}

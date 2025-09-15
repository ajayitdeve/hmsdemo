<?php

namespace App\Http\Livewire\OpdMedicineSale;

use Livewire\Component;
use App\Models\PharmacyDue;
use App\Models\User;
use App\Models\Inventory;
use App\Models\SaleStore;
use App\Models\StockPoint;
use App\Traits\ManageMedicineStock;
use App\Traits\PharmacyStockPoint;


class OpdMedicineSale extends Component
{
    use ManageMedicineStock, PharmacyStockPoint;

    public $name, $doctor_name, $doctor_department, $doctor_unit, $batch_stock;
    public $batch_no, $quantity, $unit_sale_price, $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $registration_no, $umr, $batch_nos = [], $counter, $arrCart = [];
    public $patientVisit, $patient;
    public $item_id, $item_name;
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
    public $stock_points = [];

    public function mount()
    {
        $this->checkStockPointSession();

        $this->batch_nos = null;
        $this->items = \App\Models\Item::get();
        $this->counter = 0;

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        if ($stockPoint) {
            $this->stockPoint = $stockPoint;
            $this->stock_point_id = $stockPoint?->id;
        }
        $this->stock_points = StockPoint::get();
        //all users
        $this->users = User::all();
    }

    public function umrChanged()
    {
        $patient = \App\Models\Patient::where('registration_no', $this->umr)->first();
        $this->patient = $patient;
        $patient_visit_id = $patient->patientvisits->max('id');
        $patientVisit = \App\Models\PatientVisit::find($patient_visit_id);
        $this->patientVisit = $patientVisit;
        //dd($patientVisit);

        //setting patient info
        $this->name = $patient->name;
        $this->doctor_name = $patientVisit->doctor != null ? $patientVisit->doctor->name : null;
        $this->doctor_department = $patientVisit->unit->department->name;
        $this->doctor_unit = $patientVisit->unit->name;

        //check for dues
        $this->pharmacyDue = PharmacyDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->get();
        $this->prviousDuesAmount = $this->pharmacyDue->sum('due_amount');
    }

    public function itemChanged()
    {
        $this->reset('batch_no', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');

        $item = \App\Models\Item::where('id', $this->item_id)->first();
        //first: check item is exist in SaleStores table for given stock_point id
        $isItemExist = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item?->id)->where('received', 1)->count();
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

            if ($item?->sale_rate_for_billing_used_for == 'op' || $item?->sale_rate_for_billing_used_for == 'both') {
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
        'discount' => 'required',
        'taxable_amount' => 'required',
        'cgst' => 'required',
        'sgst' => 'required',
        'total' => 'required'
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
        $cart = new \App\Services\OpdMedicineCart($this->counter, $this->item_id, $this->item_name, $this->stock_point_id, $this->batch_no, $this->exd, $this->quantity, $this->unit_sale_price, $this->amount, $this->discount, $this->taxable_amount, $this->cgst, $this->sgst, $this->total, $this->discount_approved_by_id);
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
        //save in session
        session()->put('cart-data', $this->arrCart);

        $this->calculatePayble();
        //reseting form
        $this->reset('item_id', 'batch_no', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'discountAmount', 'taxable_amount', 'cgst', 'sgst', 'total');
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
        $sum = 0;
        foreach ($this->arrCart as $item) {
            $sum = $sum + $item['total'];
        }
        $this->payableAmount = $sum + $this->prviousDuesAmount;
        $this->payingAmount = $sum + $this->prviousDuesAmount;;
    }

    public function payingAmountChanged()
    {
        // dd("Paying Amount Changed");
        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }
    public function save()
    {
        $gross_amount = 0;
        $discount_amount = 0;
        $other_amount = 0;

        $maxId = \App\Models\OpdMedicineReceipt::max('id');
        $opd_medicine_receipt_id = \App\Models\OpdMedicineReceipt::create([
            'patient_id' => $this->patient->id,
            'patient_visit_id' => $this->patientVisit->id,
            'stock_point_id' => $this->stock_point_id,
            'created_by_id' => auth()->user()?->id,
            'code' => 'OP' . $maxId + 1,
            'gross_amount' => 0,
            'discount_amount' => 0,
            'due_amount' => $this->dueAmount,
            'advance_amount' => $this->payingAmount > $this->payableAmount ? $this->payingAmount - $this->payableAmount : 0,
            'other_amount' => 0,
            'total_amount' => $this->payableAmount,
            'paid_amount' => $this->payingAmount,
            'payment_by' => 'Cash',
        ]);
        // dd($opd_medicine_receipt_id);
        $data = [];
        foreach ($this->arrCart as $item) {
            $gross_amount += $item['amount'];
            $discount_amount += ($item['amount'] * $item['discount']) / 100;
            $other_amount += $item['amount'] * ($item['cgst'] + $item['sgst']) / 100;

            $temp = [];

            $temp['opd_medicine_receipt_id'] = $opd_medicine_receipt_id->id;
            $temp['item_id'] = $item['item_id'];
            $temp['stock_point_id'] = $item['stock_point_id'];
            $temp['batch_no'] = $item['batch_no'];
            $temp['exd'] = $item['exd'];
            $temp['quantity'] = $item['quantity'];
            $temp['unit_sale_price'] = $item['unit_sale_price'];
            $temp['amount'] = $item['amount'];
            $temp['discount'] = ($item['amount'] * $item['discount']) / 100;
            $temp['taxable_amount'] = $item['taxable_amount'];
            $temp['cgst'] = $item['cgst'];
            $temp['sgst'] = $item['sgst'];
            $temp['total'] = $item['total'];
            $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
            array_push($data, $temp);
        }
        \App\Models\OpdMedicineTransaction::insert($data);

        $opd_medicine_receipt_id->update([
            'gross_amount' => $gross_amount,
            'discount_amount' => $discount_amount,
            'other_amount' => $other_amount,
        ]);

        if ($this->dueAmount) {
            //if $dueAmount!=0 then then Save due details in pharmacy_dues table
            //'stock_point_id', 'patient_id', 'patient_visit_id', 'opd_medicine_receipt_id', 'due_amount', 'is_due_cleared', 'due_clrarance_date', 'approved_by_id'
            $pharmacyDueData = [
                'stock_point_id' => $this->stock_point_id,
                'patient_id' => $this->patient->id,
                'patient_visit_id' => $this->patientVisit->id,
                'opd_medicine_receipt_id' => $opd_medicine_receipt_id->id,
                //added later total_amount and paid_amount
                'total_amount' => $this->payableAmount,
                'paid_amount' => $this->payingAmount,
                'due_amount' => $this->dueAmount,
                'is_due_cleared' => false,
                'due_clrarance_date' => null,
                'approved_by_id' => $this->due_approved_by_id,
                'created_at' => now(),
            ];
            //redirect to print
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->pharmacyDue->sum('due_amount')) {
                PharmacyDue::where('patient_id', $this->patient->id)
                    ->where('is_due_cleared', 0)
                    ->update([
                        'is_due_cleared' => 1,
                        'due_clrarance_date' => date("Y-m-d"),
                    ]);
            }
            PharmacyDue::insert($pharmacyDueData);
            return redirect()->route('admin.opd_medicine_receipt_print', $opd_medicine_receipt_id->id);
        } else {
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->pharmacyDue->sum('due_amount')) {
                PharmacyDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->update([
                    'is_due_cleared' => 1,
                    'due_clrarance_date' => date("Y-m-d")
                ]);
            }
            //redirect to print
            return redirect()->route('admin.opd_medicine_receipt_print', $opd_medicine_receipt_id->id);
        }
    }

    public function cashAmountChanged()
    {
        // dd($this->cashAmount);
        if ($this->cashAmount != 0) {
            $this->balanceAgainstCash = number_format($this->cashAmount - $this->payableAmount, 2, '.', '');
        }
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.opd-medicine-sale')->extends('layouts.admin')->section('content');
    }
}

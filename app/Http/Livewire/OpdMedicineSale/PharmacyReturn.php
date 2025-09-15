<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\OutSidePatient;
use App\Models\Rate;
use App\Models\User;
use App\Models\Patient;
use Livewire\Component;


use App\Models\Inventory;
use App\Models\SaleStore;
use App\Models\PharmacyDue;
use App\Models\RoleStockPoint;
use App\Models\OpdMedicineReceipt;
use Illuminate\Support\Facades\Auth;
use App\Models\OpdMedicineTransaction;
use App\Models\StockPoint;
use App\Traits\ManageMedicineStock;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Validator;

class PharmacyReturn extends Component
{
    use ManageMedicineStock, PharmacyStockPoint;

    public $name, $doctor_name, $doctor_department, $doctor_unit, $batch_stock;
    public $batch_no, $quantity, $unit_sale_price, $discount = 0, $amount, $taxable_amount, $cgst, $sgst, $total;
    public $registration_no, $umr, $batch_nos = [], $counter, $arrCart = [];
    public $patientVisit, $patient;
    public $item_id;
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


    public $bill_no = null, $opdMedicineTransacrions = [], $address, $opdPatientReceipt = [];
    public function mount()
    {
        $this->checkStockPointSession();

        $this->batch_nos = null;
        $this->items = \App\Models\Item::get();
        $this->counter = 0;

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stockPoint = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;
        //all users
        $this->users = User::all();
    }

    public function billNoChanged()
    {
        $opdPatientReceipt = OpdMedicineReceipt::where('code', $this->bill_no)->first();
        //check for cancled receipt
        if ($opdPatientReceipt->is_cancled == 1) {
            dd("This receipt is alredy cancledd");
        }
        $this->opdPatientReceipt = $opdPatientReceipt;
        if ($opdPatientReceipt) {
            $opdPatientReceipt->patient_id != null ? $this->is_outside_patient = false : $this->is_outside_patient = true;
            $opdPatientReceipt->out_side_patient_id != null ? $this->is_outside_patient = true : $this->is_outside_patient = false;
            if ($opdPatientReceipt->patient_id != null) {

                $this->patient = Patient::find($opdPatientReceipt->patient_id);
                //dd($this->patient);
                //$doctor_name, $doctor_department, $doctor_unit, $batch_stock;
                $this->name = $this->patient->name ? $this->patient->name : null;
                $this->registration_no = $this->patient->registration_no;
                $this->address = $this->patient->address;
            } else {
                dd("Medicine Can not be returned from outside Patient");
            }
        }
        $this->opdMedicineTransacrions = OpdMedicineTransaction::where('opd_medicine_receipt_id', $opdPatientReceipt->id)->get();
        //  dd($this->opdMedicineTransacrions);
        $this->items = collect($opdPatientReceipt->opdmedicinetransactions->pluck('item'));
    }

    public function umrChanged()
    {
        $patient = Patient::where('registration_no', $this->umr)->first();
        $this->patient = $patient;
        $patient_visit_id = $patient->patientvisits->max('id');
        $patientVisit = \App\Models\PatientVisit::find($patient_visit_id);
        $this->patientVisit = $patientVisit;
        //dd($patientVisit);

        //setting patient info
        $this->name = $patient->name;
        $this->doctor_name = $patientVisit->doctor->name;
        $this->doctor_department = $patientVisit->unit->department->name;
        $this->doctor_unit = $patientVisit->unit->name;

        //check for dues
        $this->pharmacyDue = PharmacyDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->get();
        $this->prviousDuesAmount = $this->pharmacyDue->sum('due_amount');
    }

    public function itemChanged()
    {
        $item = \App\Models\Item::where('id', $this->item_id)->first();
        //first: check item is exist in SaleStores table for given stock_point id
        $isItemExist = SaleStore::where('stock_point_id', $this->stock_point_id)->where('item_id', $item->id)->where('received', 1)->count();
        if ($isItemExist) {
            $rate = $item->rates->where('status', 0)->first();
            $this->unit_sale_price = $rate->current_sale_rate;
            $avlQty = $this->availableQuantityByItem($this->item_id);
            $this->batch_nos = null;
            $this->batch_nos = collect($avlQty);
            $this->batch_no = $avlQty[0]['batch_no'];
            $this->cgst = $item->cgst;
            $this->sgst = $item->sgst;
        }

        // dd(collect($avlQty));
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
        $cart = new \App\Services\OpdMedicineCart($this->counter, $this->item_id, $this->stock_point_id, $this->batch_no, $this->exd, $this->quantity, $this->unit_sale_price, $this->amount, $this->discountAmount, $this->taxable_amount, $this->cgst, $this->sgst, $this->total, $this->discount_approved_by_id);
        $temp = [];
        $temp['id'] = $cart->id;
        $temp['item_id'] = $cart->item_id;
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
        // session()->put('cart-data', $this->arrCart);
        $this->calculatePayble();
        //reseting form
        $this->reset('item_id', 'batch_no', 'batch_nos', 'quantity', 'unit_sale_price', 'amount', 'discount', 'taxable_amount', 'cgst', 'sgst', 'total');
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
        //$this->patientVisit;
        // dd(session()->get('cart-data'));
        $maxId = OpdMedicineReceipt::max('id');
        $opd_medicine_receipt_id = OpdMedicineReceipt::create([
            'patient_id' => $this->patient->id,
            'patient_visit_id' => $this->patientVisit->id,
            'stock_point_id' => $this->stock_point_id,
            'created_by_id' => 3,
            'code' => 'OP' . $maxId + 1
        ]);
        // dd($opd_medicine_receipt_id);
        $data = [];
        foreach ($this->arrCart as $item) {
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
            ];
            //redirect to print
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->pharmacyDue->sum('due_amount')) {
                PharmacyDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->update(['is_due_cleared' => 1]);
            }
            PharmacyDue::insert($pharmacyDueData);
            return redirect()->route('admin.opd_medicine_receipt_print', $opd_medicine_receipt_id->id);
        } else {
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->pharmacyDue->sum('due_amount')) {
                PharmacyDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->update(['is_due_cleared' => 1]);
            }
            //redirect to print
            return redirect()->route('admin.opd_medicine_receipt_print', $opd_medicine_receipt_id->id);
        }
    }

    public function cashAmountChanged()
    {
        // dd($this->cashAmount);
        if ($this->cashAmount != 0) {
            $this->balanceAgainstCash = $this->cashAmount - $this->payableAmount;
        }
    }


    public function pharmacyReturn()
    {
        //'opd_medicine_receipt_id','stock_point_id','patient_id','code','return_date','patient_type','cause','remarks','created_by_id','approved_by_id'
        $maxId = \App\Models\Pharmacy\PharmacyReturn::max('id');
        $code = 'PRD' . $maxId + 1;
        $pharmacyReturn = \App\Models\Pharmacy\PharmacyReturn::create([
            'opd_medicine_receipt_id' => $this->opdPatientReceipt?->id,
            'stock_point_id' => $this->opdPatientReceipt?->stock_point_id,
            'patient_id' => $this->opdPatientReceipt?->patient_id,
            'return_date' => date('Y-m-d H:i:s'),
            'patient_type' => $this->opdPatientReceipt?->patient_type,
            'cause' => "Some cause from front",
            'remarks' => "Remarks Goes Here",
            'created_by_id' => $this->opdPatientReceipt?->created_by_id,
            'approved_by_id' => Auth::user()?->id,
            'code' => $code,
        ]);

        if ($pharmacyReturn) {
            //'opd_medicine_receipt_id','pharmacy_return_id','item_id','stock_point_id','batch_no','exd','quantity',
            //'unit_sale_price','amount','discount','taxable_amount',
            //'cgst','sgst','total','created_by_id','approved_by_id'
            $data = [];
            foreach ($this->arrCart as $item) {
                $temp = [];
                $temp['pharmacy_return_id'] = $pharmacyReturn->id;
                $temp['opd_medicine_receipt_id'] = $this->opdPatientReceipt->id;
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
                $temp['created_by_id'] = Auth::user()?->id;
                $temp['approved_by_id'] = Auth::user()?->id;
                array_push($data, $temp);
            }
            \App\Models\Pharmacy\PharmacyReturnItem::insert($data);
        }
        // return "Refunded";
        return redirect()->route('admin.pharmacy.pharmacy-return-list')->with('message', ' Returned Successfully.');
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.pharmacy-return')->extends('layouts.admin')->section('content');;
    }
}

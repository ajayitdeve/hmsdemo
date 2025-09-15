<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\User;
use App\Models\Title;

use App\Models\Gender;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\SaleStore;
use App\Models\PharmacyDue;
use App\Models\OutSidePatient;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use App\Traits\ManageMedicineStock;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;

class OutSidePatientMedicineSale extends Component
{
    use ManageMedicineStock, PharmacyStockPoint;

    public $title_id, $titles = [], $gender_id, $genders = [], $age, $address, $mobile;
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
    public $stock_points = [];

    public function mount()
    {
        $this->checkStockPointSession();

        $this->batch_nos = null;
        $this->items = \App\Models\Item::get();
        $this->counter = 0;

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stockPoint = $stockPoint;
        $this->stock_point_id = $stockPoint?->id;

        $this->stock_points = StockPoint::get();
        //all users
        $this->users = User::all();

        //for outside
        $this->titles = Title::get();
        $this->genders = Gender::get();
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

        // 'item_id' => 'required',
        // 'batch_no' => 'required',
        // 'quantity' => 'required',
        // 'unit_sale_price' => 'required',
        // 'amount' => 'required',
        // 'discount' => 'required',
        // 'taxable_amount' => 'required',
        // 'cgst' => 'required',
        // 'sgst' => 'required',
        // 'total' => 'required',
        //for outside patients
        'name' => 'required',
        'mobile' => 'required',
        'age' => 'required',
        'address' => 'required',
        'title_id' => 'required',
        'gender_id' => 'required'

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
        $cart = new \App\Services\OpdMedicineCart($this->counter, $this->item_id, $this->stock_point_id, $this->batch_no, $this->exd, $this->quantity, $this->unit_sale_price, $this->amount, $this->discount, $this->taxable_amount, $this->cgst, $this->sgst, $this->total, $this->discount_approved_by_id);
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
        session()->put('cart-data', $this->arrCart);
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
        $this->validate();
        //firstly create outside patient

        $ospMaxId = OutSidePatient::max('id');
        $ospCode = 'OSP' . date('y') . date('m') . date('d') . $ospMaxId + 1;
        //'registration_no', 'name', 'mobile', 'age', 'address', 'title_id', 'gender_id', 'created_by_id'
        $outSidePatient = new OutSidePatient();
        $out_side_patient_id = $outSidePatient->create([
            'registration_no' => $ospCode,
            'name' => $this->name,
            'mobile' => $this->mobile,
            'age' => $this->age,
            'address' => $this->address,
            'title_id' => $this->title_id,
            'gender_id' => $this->gender_id,
            'created_by_id' => Auth::user()?->id,
        ]);
        //end of creating outside patient
        $maxId = \App\Models\OpdMedicineReceipt::max('id');
        $opd_medicine_receipt_id = \App\Models\OpdMedicineReceipt::create([
            // 'patient_id' => $this->patient->id,
            // 'patient_visit_id' => $this->patientVisit->id,
            'patient_id' => null,
            'patient_visit_id' => null,
            'out_side_patient_id' => $out_side_patient_id->id,
            'patient_type' => 'outside',

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

        //due is not applicable for outside patient , so the code for dues are removed
        //redirect to print
        return redirect()->route('admin.osp_medicine_receipt_print', $opd_medicine_receipt_id->id);
    }

    public function cashAmountChanged()
    {
        // dd($this->cashAmount);
        if ($this->cashAmount != 0) {
            $this->balanceAgainstCash = $this->cashAmount - $this->payableAmount;
        }
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.out-side-patient-medicine-sale')->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\OpdBillingOutSidePatient;

use App\Models\OutSidePatient;
use App\Models\User;
use App\Models\Title;
use App\Models\Gender;
use Livewire\Component;
use App\Models\ServiceDue;
use App\Services\ServiceCart;
use App\Models\Service\Teriff;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;

class OpdBillingOutSidePatient extends Component
{
    public $title_id, $titles = [], $gender_id, $genders = [], $age, $address, $mobile;
    public $umr, $name, $doctor_name = null, $doctor_department, $doctor_unit;
    public $patientVisit, $patient;
    public $serviceGroups = [], $teriffs = [], $services = [];
    public $service, $service_id, $rate, $calculatedRate, $quantity = 1;
    public $arrCart = [], $counter = 0;
    public $payableAmount = 0, $payingAmount = 0, $dueAmount = 0;
    public $discountAmount = 0, $discount_approved_by_id = 1, $users = [], $taxable_amount;
    public $discount = 0;
    public $due_approved_by_id = 1;
    //ServiceDue
    public $serviceyDue = null, $prviousDuesAmount = 0;

    public function mount()
    {
        $this->titles = Title::get();
        $this->genders = Gender::get();
        $this->serviceGroups = ServiceGroup::all();
        $this->teriffs = Teriff::all();
        $this->services = Service::where('ispackage', 0)->get();
        $this->users = User::all();
    }
    protected $rules = [
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

    public function serviceChanged()
    {
        //reset quantity to 1 on service change
        $this->quantity = 1;
        // dd($this->service_id);
        $this->service = Service::find($this->service_id);
        if ($this->service) {
            $this->rate = $this->service->charge;
            $this->calculatedRate = $this->rate;
            $this->total = $this->calculatedRate;
            //dd($this->rate);
            //reset discount $ and Amount
            $this->discount = 0;
            $this->discountAmount = 0;
        }
    }

    public function quantityChanged()
    {
        //reset discount $ and Amount
        $this->discount = 0;
        $this->discountAmount = 0;
        $this->calculatedRate = $this->rate * $this->quantity;
        $this->calTotal();
    }

    public function calDiscount()
    {
        if ($this->discount != null) {
            return $this->calculatedRate * $this->discount / 100;
        } else {
            return 0;
        }
    }
    public function discountChanged()
    {
        $this->taxable_amount = $this->calculatedRate - $this->calDiscount();
        //setting $discountAmount
        if ($this->discount != null) {
            $this->discountAmount = $this->calculatedRate * $this->discount / 100;
        } else {
            $this->discountAmount = 0;
        }

        $this->calTotal();
    }

    public function discountAmountChanged()
    {

        //setting $discountAmount
        $tempDiscountPercent = ($this->discountAmount * 100) / $this->calculatedRate;
        $this->discount = $tempDiscountPercent;
        $this->taxable_amount = $this->calculatedRate - $this->calDiscount();
        $this->calTotal();
    }
    public function calTotal()
    {
        $this->total = ($this->rate * $this->quantity) - $this->discountAmount;
    }
    public function addToCart()
    {
        $this->validate();
        $this->counter++;
        $cart = new ServiceCart($this->counter, $this->service_id, $this->service->code, $this->service->name, $this->quantity, $this->rate, $this->calculatedRate, $this->calDiscount(), $this->total, $this->discount_approved_by_id);
        $temp = [];
        $temp['id'] = $cart->id;
        $temp['service_code'] = $cart->service_code;
        $temp['service_name'] = $cart->service_name;
        $temp['service_id'] = $cart->service_id;
        $temp['quantity'] = $cart->quantity;
        $temp['unit_service_price'] = $cart->unit_service_price;
        $temp['amount'] = $cart->amount;
        $temp['discount'] = $cart->discount;
        $temp['total'] = $cart->total;
        $temp['discount_approved_by_id'] = $cart->discount_approved_by_id;



        array_push($this->arrCart, $temp);
        //save in session
        session()->put('cart-data', $this->arrCart);
        $this->calculatePayble();
        //reseting form
        $this->reset('service_id', 'rate', 'quantity', 'calculatedRate',);
        //reset discount $ and Amount
        $this->discount = 0;
        $this->discountAmount = 0;
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
    public function editCart($id)
    {

        unset($this->arrCart[$id - 1]);
        session()->forget('cart-data');
        session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Service Removed Successfully.');
    }
    public function save()
    {

        //fistly create outside patient

        $ospMaxId = OutSidePatient::max('id');
        $ospCode = 'OSD' . date('y') . date('m') . date('d') . $ospMaxId + 1;
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
        //dd($out_side_patient_id->id);
        $maxId = \App\Models\OpdBilling::max('id');
        $opd_billing_id = \App\Models\OpdBilling::create([
            'patient_id' => null,
            'patient_visit_id' => null,
            'out_side_patient_id' => $out_side_patient_id->id,
            'patient_type' => 'outside',
            'total' => $this->payableAmount,
            'paid' => $this->payingAmount,
            'balance' => $this->dueAmount,
            'created_by_id' => Auth::user()?->id,
            'code' => 'BILL' . date('y') . date('m') . date('d') . $maxId + 1
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $temp = [];

            $temp['opd_billing_id'] = $opd_billing_id->id;
            $temp['service_id'] = $item['service_id'];
            $temp['quantity'] = $item['quantity'];
            $temp['unit_service_price'] = $item['unit_service_price'];
            $temp['amount'] = $item['amount'];
            $temp['discount'] = $item['discount'];
            $temp['total'] = $item['total'];
            $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
            array_push($data, $temp);
        }
        // dd($data);
        \App\Models\OpdBillingItems::insert($data);


        //redirect to print
        return redirect()->route('admin.opd_billing_receipt_osp_print', $opd_billing_id->id);
    }
    public function back_to_opd_billing()
    {
        return redirect()->route('admin.opd-billing');
    }
    public function render()
    {

        return view('livewire.opd-billing-out-side-patient.opd-billing-out-side-patient')->extends('layouts.admin')->section('content');
    }
}

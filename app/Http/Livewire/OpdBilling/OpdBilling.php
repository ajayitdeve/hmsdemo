<?php

namespace App\Http\Livewire\OpdBilling;

use App\Models\Ipd\Ipd;
use App\Models\Patient;
use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\ServiceDue;
use App\Services\ServiceCart;
use App\Models\Service\Teriff;
use App\Models\Service\Service;
use App\Models\Service\ServiceGroup;
use Illuminate\Support\Facades\Auth;

class OpdBilling extends Component
{

    public $umr, $ipd, $name, $doctor_name = null, $doctor_department, $doctor_unit;
    public $patientVisit, $patient;
    public $serviceGroups = [], $teriffs = [], $services = [];
    public $service, $service_id, $rate, $calculatedRate, $quantity = 1;
    public $arrCart = [], $counter = 0, $serviceDue;
    public $payableAmount = 0, $payingAmount = 0, $dueAmount = 0;
    public $discountAmount = 0, $discount_approved_by_id = 1, $users = [], $taxable_amount;
    public $discount = 0;
    public $due_approved_by_id = 1;

    public $patient_type = 'op';

    //patient Additional Details
    public $age, $relation, $fatherName, $address, $mobile;
    //ServiceDue
    public $serviceyDue = null, $prviousDuesAmount = 0;

    public $patients = [], $ipds = [];

    public function mount()
    {
        $this->serviceGroups = ServiceGroup::all();
        $this->teriffs = Teriff::all();
        $this->services = Service::where('ispackage', 0)->get();
        $this->users = User::all();

        $this->patients = Patient::latest()->get();
        $this->ipds = Ipd::latest()->get();
    }

    public function is_outside()
    {
        if ($this->patient_type == 'outside') {
            return redirect()->route('admin.opd-billing-osp');
        }
    }
    public function umrChanged()
    {
        $patient = Patient::where('registration_no', $this->umr)->first();

        if ($patient) {
            $this->patient = $patient;
            $patient_visit_id = $patient?->patientvisits->max('id');
            $patientVisit = \App\Models\PatientVisit::find($patient_visit_id);
            if ($patientVisit == null) {
                session()->flash('error', 'Consultation Not Yet Done.');
                return;
            }

            //dd($patientVisit);
            $this->patientVisit = $patientVisit;

            //setting patient info
            $this->name = $patient->name;
            $this->relation = $patient->relation->name;
            $this->fatherName = $patient->father_name;
            $this->mobile = $patient->mobile != null ? $patient->mobile : null;
            $this->address = $patient->address;
            $this->age = Carbon::parse($patient->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->doctor_name = $patientVisit->doctor != null ? $patientVisit->doctor->name : null;
            $this->doctor_department = $patientVisit->unit->department->name;
            $this->doctor_unit = $patientVisit->unit->name;

            //check for dues
            $this->serviceDue = ServiceDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->get();
            $this->prviousDuesAmount = $this->serviceDue->sum('due_amount');
        } else {
            session()->flash('error', 'Patient Not Found.');
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::where('ipdcode', $this->ipd)->first();

        if ($ipd) {
            $patient = $ipd?->patient;

            $this->umr = $patient?->registration_no;
            $this->patient = $patient;
            $patient_visit_id = $patient?->patientvisits->max('id');
            $patientVisit = \App\Models\PatientVisit::find($patient_visit_id);
            if ($patientVisit == null) {
                session()->flash('error', 'Consultation Not Yet Done.');
                return;
            }

            //dd($patientVisit);
            $this->patientVisit = $patientVisit;

            //setting patient info
            $this->name = $patient->name;
            $this->relation = $patient->relation->name;
            $this->fatherName = $patient->father_name;
            $this->mobile = $patient->mobile != null ? $patient->mobile : null;
            $this->address = $patient->address;
            $this->age = Carbon::parse($patient->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->doctor_name = $patientVisit->doctor != null ? $patientVisit->doctor->name : null;
            $this->doctor_department = $patientVisit->unit->department->name;
            $this->doctor_unit = $patientVisit->unit->name;
            //check for dues
            $this->serviceDue = ServiceDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->get();
            $this->prviousDuesAmount = $this->serviceDue->sum('due_amount');
        } else {
            session()->flash('error', 'IPD Not Found.');
        }
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
        //$this->validate();

        foreach ($this->arrCart as $item) {
            if ($item['service_id'] == $this->service_id) {
                session()->flash('error', 'Service already added!');
                return;
            }
        }

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
        //dd("Paying Amount Changed");

        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }
    public function editCart($id)
    {
        unset($this->arrCart[$id - 1]);
        $this->calculatePayble();
        session()->forget('cart-data');
        session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Service Removed Successfully.');
    }
    public function save()
    {
        $this->validate([
            "arrCart" => "required"
        ], [
            "arrCart.required" => "Please add at least one service."
        ]);

        $gross_amount = 0;
        $discount_amount = 0;
        $other_amount = 0;

        $maxId = \App\Models\OpdBilling::max('id');
        $opd_billing_id = \App\Models\OpdBilling::create([
            'patient_id' => $this->patient->id,
            'patient_visit_id' => $this->patientVisit->id,
            // 'service_id' => $this->service->id,
            'total' => $this->payableAmount,
            'paid' => $this->payingAmount,
            'balance' => $this->dueAmount,

            'gross_amount' => 0,
            'discount_amount' => 0,
            'due_amount' => $this->dueAmount,
            'advance_amount' => $this->payingAmount > $this->payableAmount ? $this->payingAmount - $this->payableAmount : 0,
            'other_amount' => 0,
            'total_amount' => $this->payableAmount,
            'paid_amount' => $this->payingAmount,
            'payment_by' => 'Cash',

            'created_by_id' => Auth::user()?->id,
            'code' => 'BILL' . date('y') . date('m') . date('d') . $maxId + 1
        ]);

        $data = [];
        foreach ($this->arrCart as $item) {
            $gross_amount += $item['amount'];
            $discount_amount += ($item['amount'] * $item['discount']) / 100;
            // $other_amount += $item['amount'] * ($item['cgst'] + $item['sgst']) / 100;

            $temp = [];

            $temp['opd_billing_id'] = $opd_billing_id->id;
            $temp['service_id'] = $item['service_id'];
            $temp['quantity'] = $item['quantity'];
            $temp['unit_service_price'] = $item['unit_service_price'];
            $temp['amount'] = $item['amount'];
            $temp['discount'] = $item['discount'];
            // $temp['taxable_amount'] = $item['taxable_amount'];
            // $temp['cgst'] = $item['cgst'];
            // $temp['sgst'] = $item['sgst'];
            $temp['total'] = $item['total'];
            $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
            $temp['created_at'] = date('Y-m-d H:i:s');
            $temp['updated_at'] = date('Y-m-d H:i:s');

            array_push($data, $temp);
        }
        // dd($data);
        \App\Models\OpdBillingItems::insert($data);

        $opd_billing_id->update([
            'gross_amount' => $gross_amount,
            'discount_amount' => $discount_amount,
            'other_amount' => $other_amount,
        ]);

        if ($this->dueAmount) {
            //if $dueAmount!=0 then then Save due details in service_dues table
            //'stock_point_id', 'patient_id', 'patient_visit_id', 'opd_service_billing_receipt_id', 'due_amount', 'is_due_cleared', 'due_clrarance_date', 'approved_by_id'
            $serviceDueData = [
                'patient_id' => $this->patient->id,
                'patient_visit_id' => $this->patientVisit->id,
                'opd_billing_id' =>  $opd_billing_id->id,
                'total_amount' => $this->payableAmount,
                'paid_amount' => $this->payingAmount,
                'due_amount' => $this->dueAmount,
                'is_due_cleared' => false,
                'due_clrarance_date' => null,
                'approved_by_id' => $this->dueAmount > 0 ? $this->due_approved_by_id : null,
            ];
            //redirect to print
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->serviceDue->sum('due_amount')) {
                ServiceDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->update([
                    'is_due_cleared' => 1,
                    'due_clrarance_date' => date("Y-m-d")
                ]);
            }
            ServiceDue::insert($serviceDueData);
            return redirect()->route('admin.opd_billing_receipt_print', $opd_billing_id->id);
        } else {
            //clear all previvious dues i.e set is_due_cleared=1 for given patient  .. if any dues
            if ($this->serviceDue->sum('due_amount')) {
                serviceDue::where('patient_id', $this->patient->id)->where('is_due_cleared', 0)->update([
                    'is_due_cleared' => 1,
                    'due_clrarance_date' => date("Y-m-d")
                ]);
            }
            //redirect to print
            return redirect()->route('admin.opd_billing_receipt_print', $opd_billing_id->id);
        }
    }

    public function confirmation() {}

    public function render()
    {

        return view('livewire.opd-billing.opd-billing')->extends('layouts.admin')->section('content');
    }
}

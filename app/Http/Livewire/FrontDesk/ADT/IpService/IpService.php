<?php

namespace App\Http\Livewire\FrontDesk\Adt\IpService;

use App\Models\IpLabIndent;
use App\Models\IpLabIndentItem;
use App\Models\IpServiceBilling;
use App\Models\IpServiceBillingItem;
use App\Models\IpServiceBillingTransaction;
use App\Models\IpServiceDue;
use App\Models\Patient;
use App\Models\Service\Service;
use App\Models\User;
use App\Services\ServiceCart;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class IpService extends Component
{
    public $bg_color, $ipd, $is_pay = false;
    public $umr, $indent_no, $age, $status, $patient_name, $patient_type, $ward, $room, $bed, $admn_no, $admn_date, $consultant, $corporate_name;
    public $service_no, $consultant_code, $consultant_name, $remarks;

    public $payingAmount = 0, $payableAmount = 0, $dueAmount = 0;
    public $lab_indent_details = null, $arrCart = [], $patients = [], $lab_indent_list = [];

    // Add service
    public $counter = 0, $service_id, $quantity = 1, $calculatedRate, $discount = 0, $discountAmount = 0, $total = 0;
    public $rate, $discount_approved_by_id = 1, $due_approved_by_id;
    public $prviousDuesAmount, $taxable_amount, $ipServiceDue;
    public $service = null, $services = [], $users = [];
    public $is_corporate_service = false;

    // Payment
    public $payment_mode, $transaction_id;
    public $walletAmount = 0, $creditLimit = 0;

    public function generateCode()
    {
        $count = IpServiceBilling::max('id');
        return "SER" . date("Y") . date("m") . date("d") . $count + 1;
    }

    public function mount()
    {
        $this->service_no = $this->generateCode();

        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->lab_indent_list = IpLabIndent::where("is_cancelled", 0)
            ->doesntHave('indent_billing')
            ->latest()
            ->get();

        // Add service
        $this->services = Service::where('ispackage', 0)->get();
        $this->users = User::all();
    }

    public function umrChanged()
    {
        $patient = Patient::with(["ipds"])->where("registration_no", $this->umr)->whereHas("ipds")->first();
        if ($patient) {
            $this->lab_indent_list = IpLabIndent::where("patient_id", $patient->id)
                ->where("is_cancelled", 0)
                ->doesntHave('indent_billing')
                ->latest()
                ->get();

            $ipd = $patient->ipds()->latest()->first();
            $this->ipd = $ipd;

            $this->indent_no = null;
            $this->patient_name = $patient?->name;
            $this->status = "Not Approved";
            $this->patient_type = $patient?->patienttype->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->admn_no = $ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->consultant = $ipd?->patient_visit?->doctor?->name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;
            $this->is_corporate_service = $ipd?->corporate_registration ? true : false;

            $this->consultant_code = $ipd?->patient_visit?->doctor?->code;
            $this->consultant_name = $ipd?->patient_visit?->doctor?->name;
            $this->remarks = "";

            $this->arrCart = [];

            $this->walletAmount = $ipd?->wallet?->amount;
            $this->creditLimit = $ipd?->wallet?->credit_limit;

            $this->payableAmount = 0;
            $this->payingAmount = 0;
            $this->dueAmount = 0;

            //check for dues
            $this->ipServiceDue = IpServiceDue::where('patient_id', $patient->id)
                ->where('ipd_id', $ipd->id)
                ->where('is_due_cleared', 0)
                ->get();

            $this->prviousDuesAmount = $this->ipServiceDue->sum('due_amount');

            $this->is_pay = true;
        }
    }

    public function indentChanged()
    {
        $lab_indent = IpLabIndent::where("code", $this->indent_no)->first();
        if ($lab_indent) {
            $this->lab_indent_details = $lab_indent;

            $this->umr = $lab_indent->ipd?->patient?->registration_no;
            $this->patient_name = $lab_indent->ipd?->patient?->name;
            $this->status = $lab_indent->status;
            $this->patient_type = $lab_indent->ipd?->patient?->patienttype->name;
            $this->age = Carbon::parse($lab_indent->ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->ward = $lab_indent->ipd?->ward?->name;
            $this->room = $lab_indent->ipd?->room?->name;
            $this->bed = $lab_indent->ipd?->bed?->display_name;
            $this->admn_no = $lab_indent->ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($lab_indent->ipd?->created_at));
            $this->consultant = $lab_indent->ipd?->patient_visit?->doctor?->name;
            $this->corporate_name = $lab_indent->ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $lab_indent->ipd?->corporate_registration?->organization?->color;
            $this->is_corporate_service = $lab_indent->ipd?->corporate_registration ? true : false;

            $this->consultant_code = $lab_indent->ipd?->patient_visit?->doctor?->code;
            $this->consultant_name = $lab_indent->ipd?->patient_visit?->doctor?->name;
            $this->remarks = $lab_indent->remarks;

            $this->walletAmount = $lab_indent->ipd?->wallet?->amount;
            $this->creditLimit = $lab_indent->ipd?->wallet?->credit_limit;

            $this->arrCart = $lab_indent->indent_items;
            $this->payableAmount = $lab_indent->indent_items()->sum('total');
            $this->payingAmount = $lab_indent->indent_items()->sum('total');
            $this->dueAmount = 0;

            //check for dues
            $this->ipServiceDue = IpServiceDue::where('patient_id', $lab_indent->patient_id)
                ->where('ipd_id', $lab_indent->ipd_id)
                ->where('is_due_cleared', 0)
                ->get();

            $this->prviousDuesAmount = $this->ipServiceDue->sum('due_amount');
            $this->calculatePayble();

            $this->is_pay = true;
        } else {
            $this->resetInput();
        }
    }

    public function resetInput()
    {
        $this->umr = "";
        $this->patient_name = "";
        $this->status = "";
        $this->patient_type = "";
        $this->age = "";
        $this->ward = "";
        $this->room = "";
        $this->bed = "";
        $this->admn_no = "";
        $this->admn_date = "";
        $this->consultant = "";
        $this->corporate_name = "";
        $this->bg_color = "#ffff";
        $this->consultant_code = "";
        $this->consultant_name = "";
        $this->is_corporate_service = false;
        $this->remarks = "";

        $this->lab_indent_details = null;
        $this->arrCart = [];
        $this->payableAmount = 0;
        $this->payingAmount = 0;
        $this->dueAmount = 0;
        $this->is_pay = false;
    }

    public function save()
    {
        if (!$this->indent_no) {
            $this->validate(
                [
                    'umr' => 'required',
                    'admn_no' => 'required',
                    'consultant_code' => 'required',
                    'consultant_name' => 'required',
                    'arrCart' => 'required|array',
                ],
                [
                    'arrCart.required' => 'Please add at least one service.',
                ]
            );

            $count = IpLabIndent::max('id');
            $indent_code =  "IND" . date("y") . date("m") . date("d") . $count + 1;

            $lab_indent = IpLabIndent::create([
                "ipd_id" => $this->ipd?->id,
                "patient_id" => $this->ipd?->patient?->id,
                "code" => $indent_code,
                "remarks" => null,
                "instructions" => null,
                "clinical_summary_diagnosis" => null,
                "status" => $this->status,
                'nurse_station_id' => null,
                "created_by_id" => auth()->user()?->id,
                "is_cancelled" => 0,
            ]);

            $data = [];
            foreach ($this->arrCart as $item) {
                $temp = [];

                $temp['ip_lab_indent_id'] = $lab_indent->id;
                $temp['is_corporate_service'] = $item['is_corporate_service'];
                $temp['corporate_service_fee_id'] = $item['corporate_service_fee_id'];
                $temp['service_id'] = $item['service_id'];
                $temp['quantity'] = $item['quantity'];
                $temp['unit_service_price'] = $item['unit_service_price'];
                $temp['amount'] = $item['amount'];
                $temp['discount'] = $item['discount'];
                // $temp['taxable_amount'] = $item['taxable_amount'];
                // $temp['cgst'] = $item['cgst'];
                // $temp['sgst'] = $item['sgst'];
                $temp['total'] = $item['total'];
                $temp['service_date'] = $item['service_date'];
                $temp['discount_approved_by_id'] = $item['discount_approved_by_id'];
                $temp['created_at'] = date('Y-m-d H:i:s');
                $temp['updated_at'] = date('Y-m-d H:i:s');

                array_push($data, $temp);
            }

            IpLabIndentItem::insert($data);

            $this->indent_no = $lab_indent->code;

            $lab_indent = IpLabIndent::where("code", $this->indent_no)->first();
            if ($lab_indent) {
                $this->lab_indent_details = $lab_indent;

                $this->umr = $lab_indent->ipd?->patient?->registration_no;
                $this->patient_name = $lab_indent->ipd?->patient?->name;
                $this->status = $lab_indent->status;
                $this->patient_type = $lab_indent->ipd?->patient?->patienttype->name;
                $this->age = Carbon::parse($lab_indent->ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
                $this->ward = $lab_indent->ipd?->ward?->name;
                $this->room = $lab_indent->ipd?->room?->name;
                $this->bed = $lab_indent->ipd?->bed?->display_name;
                $this->admn_no = $lab_indent->ipd?->ipdcode;
                $this->admn_date = date("Y-m-d H:i", strtotime($lab_indent->ipd?->created_at));
                $this->consultant = $lab_indent->ipd?->patient_visit?->doctor?->name;
                $this->corporate_name = $lab_indent->ipd?->organization?->name;
                $this->bg_color = "#" . $lab_indent->ipd?->organization?->color;

                $this->consultant_code = $lab_indent->ipd?->patient_visit?->doctor?->code;
                $this->consultant_name = $lab_indent->ipd?->patient_visit?->doctor?->name;
                $this->remarks = $lab_indent->remarks;

                $this->arrCart = $lab_indent->indent_items;

                $this->is_pay = true;
            }
        }

        $this->validate([
            "umr" => "required",
            "indent_no" => "required",
            "service_no" => "required",
            "payableAmount" => "required",
            "payment_mode" => "required",
            "transaction_id" => "required_if:payment_mode,online",
        ]);

        if (isset($this->lab_indent_details?->ipd?->wallet) && $this->lab_indent_details?->ipd?->wallet) {

            $bill = IpServiceBilling::where('ip_lab_indent_id', $this->lab_indent_details?->id)
                ->where("ipd_id", $this->lab_indent_details?->ipd?->id)
                ->where("patient_id", $this->lab_indent_details?->ipd?->patient?->id)
                ->count();

            if ($bill) {
                session()->flash('error', 'Bill already generated for this service indent');
                return;
            }

            $balance_check = wallet_check_amount_limit($this->lab_indent_details?->ipd_id, $this->lab_indent_details?->ipd?->patient?->id, $this->payment_mode, $this->payingAmount);
            if ($balance_check['error']) {
                session()->flash('error', $balance_check['msg']);
                return;
            }

            $gross_amount = 0;
            $discount_amount = 0;
            $other_amount = 0;

            DB::beginTransaction();
            try {
                $ip_service_billing = IpServiceBilling::create([
                    "ip_lab_indent_id" => $this->lab_indent_details->id,
                    "ipd_id" => $this->lab_indent_details?->ipd?->id,
                    "patient_id" => $this->lab_indent_details?->ipd?->patient?->id,
                    "code" => $this->generateCode(),
                    "total" => $this->payingAmount,
                    "remarks" => $this->remarks,
                    'gross_amount' => 0,
                    'discount_amount' => 0,
                    'due_amount' => $this->dueAmount,
                    'advance_amount' => $this->payingAmount > $this->payableAmount ? $this->payingAmount - $this->payableAmount : 0,
                    'other_amount' => 0,
                    'total_amount' => $this->payableAmount,
                    'paid_amount' => $this->payingAmount,
                    'payment_by' => $this->payment_mode,
                    "created_by_id" => auth()->user()?->id,
                ]);

                $data = [];
                foreach ($this->arrCart as $item) {
                    $gross_amount += $item['amount'];
                    $discount_amount += ($item['amount'] * $item['discount']) / 100;
                    // $other_amount += $item['amount'] * ($item['cgst'] + $item['sgst']) / 100;

                    $temp = [];
                    $temp['ip_service_billing_id'] = $ip_service_billing->id;

                    $temp['is_corporate_service'] = $item['is_corporate_service'];
                    $temp['corporate_service_fee_id'] = $item['corporate_service_fee_id'];

                    $temp['service_id'] = $item['service_id'];
                    $temp['quantity'] = $item['quantity'];
                    $temp['unit_service_price'] = $item['unit_service_price'];
                    $temp['amount'] = $item['amount'];
                    $temp['discount'] = $item['discount'];
                    // $temp['taxable_amount'] = $item['taxable_amount'];
                    // $temp['cgst'] = $item['cgst'];
                    // $temp['sgst'] = $item['sgst'];
                    $temp['total'] = $item['total'];
                    $temp['created_at'] = date('Y-m-d H:i:s');
                    $temp['updated_at'] = date('Y-m-d H:i:s');

                    array_push($data, $temp);
                }

                IpServiceBillingItem::insert($data);

                $wallet_transaction = wallet_transaction($this->lab_indent_details?->ipd_id, $this->lab_indent_details?->ipd?->patient?->id, $this->payingAmount, $this->payment_mode, $this->transaction_id, "success");

                $ip_service_billing->update([
                    'gross_amount' => $gross_amount,
                    'discount_amount' => $discount_amount,
                    'other_amount' => $other_amount,
                ]);

                $this->lab_indent_details->status = "Approved";
                $this->lab_indent_details->save();

                if ($this->dueAmount) {
                    $serviceDueData = [
                        'patient_id' => $this->lab_indent_details?->ipd?->patient?->id,
                        'ipd_id' => $this->lab_indent_details?->ipd?->id,
                        'ip_service_billing_id' =>  $ip_service_billing->id,
                        'total_amount' => $this->payableAmount,
                        'paid_amount' => $this->payingAmount,
                        'due_amount' => $this->dueAmount,
                        'is_due_cleared' => false,
                        'due_clrarance_date' => null,
                        'approved_by_id' => $this->dueAmount > 0 ? $this->due_approved_by_id : null,
                    ];

                    if ($this->ipServiceDue->sum('due_amount')) {
                        IpServiceDue::where('patient_id', $this->lab_indent_details?->ipd?->patient?->id)
                            ->where('ipd_id', $this->lab_indent_details?->ipd?->id)
                            ->where('is_due_cleared', 0)
                            ->update([
                                'is_due_cleared' => 1,
                                'due_clrarance_date' => date('Y-m-d'),
                            ]);
                    }
                    IpServiceDue::create($serviceDueData);
                } else {
                    if ($this->ipServiceDue->sum('due_amount')) {
                        IpServiceDue::where('patient_id', $this->lab_indent_details?->ipd?->patient?->id)
                            ->where('ipd_id', $this->lab_indent_details?->ipd?->id)
                            ->where('is_due_cleared', 0)
                            ->update([
                                'is_due_cleared' => 1,
                                'due_clrarance_date' => date('Y-m-d'),
                            ]);
                    }
                }

                IpServiceBillingTransaction::create([
                    'ip_service_billing_id' => $ip_service_billing->id,
                    "ip_lab_indent_id" => $this->lab_indent_details->id,
                    'ipd_id' => $this->lab_indent_details?->ipd_id,
                    'patient_id' => $this->lab_indent_details?->ipd?->patient?->id,
                    'wallet_transaction_id' => $wallet_transaction->id,
                    'amount' => $this->payingAmount,
                    'received_by_id' => auth()->user()?->id,
                ]);

                DB::commit();
                return redirect()->route("admin.front-desk.adt.ip-service.billing.print", $ip_service_billing->id);
            } catch (\Exception $e) {
                DB::rollBack();
                session()->flash('error', 'Something went wrong ' . $e->getMessage());
                return;
            }
        }

        session()->flash('error', 'Wallet account not found...');
    }

    // Add service
    public function serviceChanged()
    {
        $this->quantity = 1;
        $this->service = Service::find($this->service_id);

        if ($this->service) {
            $this->rate = number_format($this->service->charge, 2, '.', '');

            // For corporate service
            if ($this->is_corporate_service) {
                $rate = $this->service?->corporate_service_fee?->charge ? number_format($this->service?->corporate_service_fee?->charge, 2, '.', '') : $this->rate;
                $this->rate = $rate;
            }


            $this->calculatedRate = $this->rate;
            $this->total = $this->calculatedRate;
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
        $this->calculatedRate = number_format($this->rate * $this->quantity, 2, '.', '');
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
        $this->total = number_format(($this->rate * $this->quantity) - $this->discountAmount, 2, '.', '');
    }

    public function calculatePayble()
    {
        $sum = 0;
        foreach ($this->arrCart as $item) {
            $sum = $sum + $item['total'];
        }
        $this->payableAmount = number_format($sum + $this->prviousDuesAmount, 2, '.', '');
        $this->payingAmount = number_format($sum + $this->prviousDuesAmount, 2, '.', '');
    }

    public function payingAmountChanged()
    {
        //dd("Paying Amount Changed");
        $this->dueAmount = $this->payableAmount - $this->payingAmount;
    }

    public function serviceDateChanged($index, $date)
    {
        $this->arrCart[$index]['service_date'] = $date;
    }

    public function deleteCart($index)
    {
        unset($this->arrCart[$index]);
        $this->calculatePayble();
        // session()->forget('cart-data');
        // session()->put('cart-data', $this->arrCart);
        $this->render();
        session()->flash('message', 'Service Removed Successfully.');
    }

    public function addToCart()
    {
        //$this->validate();
        $this->counter++;
        $cart = new ServiceCart($this->counter, $this->service_id, $this->service->code, $this->service->name, $this->quantity, $this->rate, $this->calculatedRate, $this->calDiscount(), $this->total, $this->discount_approved_by_id);

        $temp = [];
        $temp['id'] = $cart->id;
        $temp['service_id'] = $cart->service_id;
        $temp['service_name'] = $cart->service_name;
        $temp['service_code'] = $cart->service_code;
        $temp['service_date'] = date("Y-m-d");
        $temp['quantity'] = $cart->quantity;
        $temp['service_group_department'] = $this->service?->servicegroup?->name;
        $temp['unit_service_price'] = $cart->unit_service_price;
        $temp['amount'] = $cart->amount;
        $temp['discount'] = $cart->discount;
        $temp['total'] = $cart->total;
        $temp['discount_approved_by_id'] = $cart->discount_approved_by_id;

        $temp['is_corporate_service'] = false;
        $temp['corporate_service_fee_id'] = null;

        // For corporate service
        if ($this->is_corporate_service) {
            $temp['is_corporate_service'] = $this->service?->corporate_service_fee ? true : false;
            $temp['corporate_service_fee_id'] = $this->service?->corporate_service_fee?->id ?: null;
            $temp['service_name'] = $this->service?->corporate_service_fee?->name ?: $cart->service_name;
            $temp['service_code'] = $this->service?->corporate_service_fee?->code ?: $cart->service_code;
        }

        array_push($this->arrCart, $temp);
        //save in session
        // session()->put('cart-data', $this->arrCart);
        $this->calculatePayble();
        //reseting form
        $this->reset('service_id', 'rate', 'quantity', 'calculatedRate', 'total');
        //reset discount $ and Amount
        $this->discount = 0;
        $this->discountAmount = 0;
    }

    public function render()
    {
        return view('livewire.front-desk.adt.ip-service.ip-service')->extends('layouts.admin')->section('content');
    }
}

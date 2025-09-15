<?php

namespace App\Http\Livewire\Ipd\IpdFinalBill;

use App\Models\Ipd\Organization;
use App\Models\IpFinalBilling;
use App\Models\IpPharmacyIndentBilling;
use App\Models\IpPreRefund;
use App\Models\IpServiceBilling;
use App\Models\Patient;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class IpdFinalBillMaster extends Component
{
    public $bg_color, $bill_no, $bill_date, $umr, $patient_name, $age, $status;
    public $admn_no, $admn_date, $gender, $patient_type, $consultant, $ward, $room, $bed, $corporate_name;
    public $gross_amount = 0, $total_advance = 0, $excess_amount = 0, $concession = 0, $due_amount = 0, $amount = 0, $payment_mode, $transaction_id;
    public $ipd_wallet_amount = 0, $ipd_credit_limit = 0, $total_credit_limit = 0;
    public $ipd_id, $patient_id;
    public $receipt_amount = 0, $due_authorized_by_id, $concession_authorized_by_id, $remarks;

    public $patients = [];
    public $organizations = [];
    public $ip_pharmacy_indent_billings = [];
    public $ip_service_billings = [];
    public $advance_list = [];

    public $payment_modes = [
        'cash' => "Cash",
        'online' => "Online",
    ];

    public function mount()
    {
        $this->payment_mode = $this->payment_modes['cash'];
        $this->generateBillNo();

        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->organizations = Organization::get();
        $this->status = "Not Approved";
    }

    public function generateBillNo()
    {
        $maxId = IpFinalBilling::max('id');
        $this->bill_no = 'FB' . date('y') . date('m') . date('d') . $maxId + 1;
        $this->bill_date = date('Y-m-d H:i');
    }

    public function umrChanged()
    {
        $patient = Patient::where("registration_no", $this->umr)->first();
        if ($patient) {
            $ipd = $patient->ipds()->latest()->first();
            $this->ipd_id = $ipd?->id;

            $this->patient_id = $patient?->id;
            $this->patient_name = $patient?->name;
            $this->age = Carbon::parse($patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->admn_no = $ipd?->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->gender = $patient?->gender?->name;
            $this->patient_type = $patient?->patienttype?->name;
            $this->consultant = $ipd?->patient_visit?->doctor?->name;;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->ipd_wallet_amount = $ipd?->wallet?->amount;
            $this->ipd_credit_limit = $ipd?->wallet?->credit_limit;
            $this->total_credit_limit = $ipd?->wallet?->total_credit_limit;

            // IPd Extra Amount
            $this->excess_amount = $this->ipd_wallet_amount;

            // IPd Due Amount
            $this->due_amount = number_format($this->total_credit_limit - $this->ipd_credit_limit, 2, '.', '');

            $this->ipd_transactions();
        } else {
        }
    }

    public function ipd_transactions()
    {
        $ip_pharmacy_indent_billings = IpPharmacyIndentBilling::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->latest()
            ->get();


        $ip_service_billings = IpServiceBilling::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->latest()
            ->get();


        $this->ip_pharmacy_indent_billings = $ip_pharmacy_indent_billings;
        $this->ip_service_billings = $ip_service_billings;

        $this->gross_amount = number_format($ip_service_billings->sum("paid_amount") + $ip_pharmacy_indent_billings->sum("paid_amount"), 2, '.', '');

        $wallet_advances = WalletTransaction::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->where("type", "credit")
            ->where("status", "success")
            ->get();

        $ip_pre_refund = IpPreRefund::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->sum("amount");

        $this->advance_list = $wallet_advances;

        $this->total_advance = number_format($wallet_advances->sum("amount") - $ip_pre_refund, 2, '.', '');
        $this->calculation();
    }

    public function concessionChanged()
    {
        $this->calculation();
    }

    public function calculation()
    {
        if ($this->total_advance >= $this->gross_amount) {
            $amount = ($this->total_advance - $this->gross_amount) - $this->concession;
            $this->amount = number_format($amount, 2, '.', '');
            $this->receipt_amount = $this->amount;
        } else {
            $amount = ($this->due_amount - $this->total_advance) - $this->concession;
            $this->amount = number_format($amount, 2, '.', '');
            $this->receipt_amount = $this->amount;
        }
    }

    public function amountChanged()
    {
        $this->receipt_amount = $this->amount;
    }

    public function save()
    {
        $this->validate([
            'ipd_id' => 'required',
            'patient_id' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
            "transaction_id" => "required_if:payment_mode,online",
            'concession_authorized_by_id' => [
                Rule::requiredIf(function () {
                    return $this->concession > 0;
                }),
            ],
        ]);

        if ($this->excess_amount > 0) {
            session()->flash('error', 'Excess amount should be zero.');
            return;
        }

        $final_bill = IpFinalBilling::where("ipd_id", $this->ipd_id)->where("patient_id", $this->patient_id)->exists();

        if ($final_bill) {
            session()->flash('error', 'IP Final Bill already exists.');
            return;
        }

        if ($this->due_amount > 0 && $this->amount == $this->due_amount) {

            $ip_final_bill = IpFinalBilling::create([
                'ipd_id' => $this->ipd_id,
                'patient_id' => $this->patient_id,
                'bill_no' => $this->bill_no,
                'bill_date' => $this->bill_date,
                'gross_amount' => $this->gross_amount,
                'total_advance' => $this->total_advance,
                'excess_amount' => $this->excess_amount,
                'receipt_amount' => $this->receipt_amount,
                'due_amount' => $this->due_amount,
                'due_authorized_by_id' => $this->due_authorized_by_id ?: null,
                'concession' => $this->concession,
                'concession_authorized_by_id' => $this->concession_authorized_by_id ?: null,
                'amount' => $this->amount,
                'payment_mode' => $this->payment_mode,
                'transaction_id' => $this->transaction_id ?: null,
                'remarks' => $this->remarks ?: null,
                'created_by_id' => auth()->user()?->id
            ]);

            WalletTransaction::create([
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                "type" => "credit",
                "amount" => $this->amount,
                "mode" => $this->payment_mode,
                "transaction_id" => $this->transaction_id,
                "status" => "success",
                "created_by_id" => auth()->user()?->id,
            ]);

            Wallet::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->update([
                    "credit_limit" => 0,
                    "total_credit_limit" => 0
                ]);

            session()->flash('success', 'Final Billing Successfully.');
            return redirect()->route('admin.ipd.ip-final-bill.print', $ip_final_bill?->id);
        }

        session()->flash('error', 'Something went wront ! Try Again');
    }

    public function render()
    {
        return view('livewire.ipd.ipd-final-bill.ipd-final-bill-master')->extends('layouts.admin')->section('content');
    }
}

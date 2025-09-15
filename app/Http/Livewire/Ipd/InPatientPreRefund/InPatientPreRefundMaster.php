<?php

namespace App\Http\Livewire\Ipd\InPatientPreRefund;

use App\Models\IpPharmacyIndentBilling;
use App\Models\IpPreRefund;
use App\Models\IpServiceBilling;
use App\Models\Patient;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Livewire\Component;

class InPatientPreRefundMaster extends Component
{
    public $ipd_id, $patient_id;
    public $bg_color, $umr, $patient_name, $age, $status, $admn_no, $admn_date, $gender;
    public $patient_type, $consultant, $ward, $room, $bed, $corporate_name;

    public $refund_no, $refund_date;
    public $gross_amount = 0, $total_advance = 0, $excess_amount = 0, $due_amount = 0, $amount = 0, $payment_mode, $transaction_id, $remarks;
    public $ipd_wallet_amount = 0, $ipd_credit_limit = 0, $total_credit_limit = 0;

    public $patients = [];
    public $prev_advance_list = [];

    public $payment_modes = [
        'cash' => "Cash",
        'online' => "Online",
    ];

    public function mount()
    {
        $this->payment_mode = $this->payment_modes['cash'];
        $this->generateBillNo();

        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->status = "Not Approved";
    }

    public function generateBillNo()
    {
        // $maxId = IpPreRefund::max('id');
        $maxId = 0;
        $this->refund_no = 'RF' . date('y') . date('m') . date('d') . $maxId + 1;
        $this->refund_date = date('Y-m-d H:i');
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
        $ip_service_billings = IpServiceBilling::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->sum("paid_amount");

        $ip_pharmacy_indent_billings = IpPharmacyIndentBilling::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->sum("paid_amount");

        $this->gross_amount = number_format($ip_service_billings + $ip_pharmacy_indent_billings, 2, '.', '');

        $wallet_advances = WalletTransaction::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->where("type", "credit")
            ->where("status", "success")
            ->get();

        $ip_pre_refund = IpPreRefund::where("ipd_id", $this->ipd_id)
            ->where("patient_id", $this->patient_id)
            ->sum("amount");

        $this->prev_advance_list = $wallet_advances;

        $this->total_advance = number_format($wallet_advances->sum("amount") - $ip_pre_refund, 2, '.', '');
        $this->calculation();
    }

    public function calculation()
    {
        if ($this->total_advance >= $this->gross_amount) {
            $amount =  $this->total_advance - $this->gross_amount;
            $this->amount = number_format($amount, 2, '.', '');
        } else {
            $amount = $this->gross_amount - $this->due_amount;
            $this->amount = number_format($amount, 2, '.', '');
        }
    }

    public function save()
    {
        $this->validate([
            'ipd_id' => 'required',
            'patient_id' => 'required',
            'amount' => 'required',
            'payment_mode' => 'required',
            "transaction_id" => "required_if:payment_mode,online",
        ]);

        if ($this->excess_amount > 0) {

            $ip_pre_refund = IpPreRefund::create([
                'ipd_id' => $this->ipd_id,
                'patient_id' => $this->patient_id,
                'refund_no' => $this->refund_no,
                'refund_date' => date("Y-m-d H:i:s"),
                'gross_amount' => $this->gross_amount,
                'total_advance' => $this->total_advance,
                'due_amount' => $this->due_amount,
                'amount' => $this->amount,
                'payment_mode' => $this->payment_mode,
                'transaction_id' => $this->transaction_id,
                'remarks' => $this->remarks,
                'created_by_id' => auth()->user()?->id
            ]);

            Wallet::where("ipd_id", $this->ipd_id)
                ->where("patient_id", $this->patient_id)
                ->decrement("amount", $this->amount);

            session()->flash('success', 'Pre Refund Successfully !');
            return redirect()->route('admin.ipd.in-patient-pre-refund.print', $ip_pre_refund?->id);
        } else {
            session()->flash('error', 'Something went wront ! Try Again');
            return;
        }
    }

    public function render()
    {
        return view('livewire.ipd.in-patient-pre-refund.in-patient-pre-refund-master')->extends('layouts.admin')->section('content');
    }
}

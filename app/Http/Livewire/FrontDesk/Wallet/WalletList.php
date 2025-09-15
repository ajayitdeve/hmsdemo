<?php

namespace App\Http\Livewire\FrontDesk\Wallet;

use App\Models\Ipd\Ipd;
use App\Models\Patient;
use App\Models\WalletTransaction;
use Livewire\Component;

class WalletList extends Component
{
    public $patient_name, $father_name, $mobile;
    public $patient_id, $ipd_id, $ipd_date, $wallet_amount = 0, $wallet_credit_limit = 0, $amount;
    public $mode = "cash", $transaction_id;
    public $wallet_transactions = [];

    public $patients = [];
    public $ipds = [];
    public function mount()
    {
        $this->patients = Patient::whereHas("ipds")->latest()->get();
        $this->ipds = Ipd::whereHas("patient")->latest()->get();
        $this->wallet_transactions = WalletTransaction::where("type", "credit")->whereIn("mode", ["cash", "online"])->latest()->get();
    }

    public function umrChanged()
    {
        $patient = Patient::where("id", $this->patient_id)->first();
        if ($patient) {
            $this->patient_name = $patient?->name;
            $this->father_name = $patient?->father_name;
            $this->mobile = $patient?->mobile;

            $this->ipds = $patient->ipds()->latest()->get();
        }
    }

    public function ipdChanged()
    {
        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $this->patient_id = $ipd?->patient?->id;
            $this->patient_name = $ipd?->patient?->name;
            $this->father_name = $ipd?->patient?->father_name;
            $this->mobile = $ipd?->patient?->mobile;

            $this->ipd_date = date("Y-m-d H:i", strtotime($ipd?->created_at));
            $this->wallet_amount = $ipd?->wallet?->amount ?? 0;
            $this->wallet_credit_limit = $ipd?->wallet?->credit_limit ?? 0;
        }
    }

    public function rules()
    {
        return [
            "patient_id" => "required",
            "patient_name" => "required",
            "ipd_id" => "required",
            "ipd_date" => "required",
            "mode" => "required|in:cash,online",
            "transaction_id" => "required_if:mode,online",
            "amount" => "required|numeric|min:1",
        ];
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function save()
    {
        $this->validate();

        $ipd = Ipd::find($this->ipd_id);
        if ($ipd) {
            $ipd->wallet()->update([
                "amount" => $this->wallet_amount + $this->amount,
            ]);

            WalletTransaction::create([
                "ipd_id" => $this->ipd_id,
                "patient_id" => $this->patient_id,
                "type" => "credit",
                "amount" => $this->amount,
                "mode" => $this->mode,
                "transaction_id" => $this->transaction_id,
                "status" => "success",
                "created_by_id" => auth()->user()?->id,
            ]);

            session()->flash("success", "Amount Added Successfully.");
            $this->reset(["patient_id", "patient_name", "father_name", "mobile", "ipd_id", "ipd_date", "wallet_amount", "wallet_credit_limit", "amount"]);
            $this->mount();
            $this->dispatchBrowserEvent("close-modal");
            return;
        }

        session()->flash("error", "Something went wrong.");
    }

    public function render()
    {
        return view('livewire.front-desk.wallet.wallet-list')->extends('layouts.admin')->section('content');
    }
}

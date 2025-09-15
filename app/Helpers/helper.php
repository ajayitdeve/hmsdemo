<?php

use App\Models\PatientCreditLimit;
use App\Models\Wallet;
use App\Models\WalletTransaction;

if (!function_exists('provide_all_permission')) {
    function provide_all_permission($user)
    {
        return $user->hasRole('admin');
    }
}

if (!function_exists('create_wallet')) {
    function create_wallet($ipd_id, $patient_id)
    {
        $default_credit_limit = config("app.default_credit_limit");

        Wallet::create([
            'ipd_id' => $ipd_id,
            'patient_id' => $patient_id,
            'amount' => "00.00",
            'credit_limit' => $default_credit_limit,
            'default_credit_limit' => $default_credit_limit,
            'total_credit_limit' => $default_credit_limit,
            'created_by_id' => auth()->user()?->id
        ]);

        if ($default_credit_limit > 0) {
            PatientCreditLimit::create([
                "patient_id" => $patient_id,
                "ipd_id" => $ipd_id,
                "credit_limit" => $default_credit_limit,
                "authrization_by" => null,
                "remarks" => "Default Credit Limit",
                "created_by_id" => auth()->user()?->id,
            ]);
        }
    }
}

if (!function_exists('wallet_check_amount_limit')) {
    function wallet_check_amount_limit($ipd_id, $patient_id, $mode, $payingAmount = 0)
    {
        if ($mode == "cash" || $mode == "online") {
            return [
                "error" => false,
                "msg" => "Continue",
            ];
        }

        $wallet = Wallet::where("ipd_id", $ipd_id)
            ->where("patient_id", $patient_id)
            ->first();

        if ($wallet->amount < $payingAmount && $wallet->credit_limit < $payingAmount) {
            return [
                "error" => true,
                "msg" => "Insufficient balance please recharge your wallet.",
            ];
        }

        return [
            "error" => false,
            "msg" => "Continue",
        ];
    }
}

if (!function_exists('wallet_transaction')) {
    function wallet_transaction($ipd_id, $patient_id, $payingAmount = 0, $mode = "cash", $transaction_id = null, $status = "success")
    {
        if (($mode == "cash" || $mode == "online") && $payingAmount > 0) {
            WalletTransaction::create([
                "ipd_id" => $ipd_id,
                "patient_id" => $patient_id,
                "type" => "credit",
                "amount" => $payingAmount,
                "mode" => $mode,
                "transaction_id" => $transaction_id,
                "status" => $status,
                "created_by_id" => auth()->user()?->id,
            ]);

            Wallet::where("ipd_id", $ipd_id)
                ->where("patient_id", $patient_id)
                ->increment("amount", $payingAmount);
        }

        $wallet_transaction = WalletTransaction::create([
            "ipd_id" => $ipd_id,
            "patient_id" => $patient_id,
            "type" => "debit",
            "amount" => $payingAmount,
            "mode" => $mode,
            "transaction_id" => $transaction_id,
            "status" => $status,
            "created_by_id" => auth()->user()?->id,
        ]);

        $wallet = Wallet::where("ipd_id", $ipd_id)
            ->where("patient_id", $patient_id)->first();

        if ($wallet->amount >= $payingAmount) {
            $wallet->amount -=  $payingAmount;
            $wallet->save();
        } elseif ($wallet->credit_limit >= $payingAmount) {
            $wallet->credit_limit -= $payingAmount;
            $wallet->save();
        }

        return $wallet_transaction;
    }
}

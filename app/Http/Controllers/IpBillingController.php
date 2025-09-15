<?php

namespace App\Http\Controllers;

use App\Models\IpDischarge;
use App\Models\IpFinalBilling;
use App\Models\IpPharmacyIndentBilling;
use App\Models\IpPreRefund;
use App\Models\IpServiceBilling;

class IpBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function print($bill_id)
    {

        $ipBilling = IpPharmacyIndentBilling::findOrFail($bill_id);

        //total amount
        $totalAmount = number_format(($ipBilling->ip_billing_items->sum('total')), 2, '.', ',');
        //total taxabale amount
        $totaldDiscount = number_format(($ipBilling->ip_billing_items->sum('discount')), 2, '.', ',');

        $discountedAmount = ($ipBilling->ip_billing_items->sum('total')) - ($ipBilling->ip_billing_items->sum('discount'));
        $createdBy = \App\Models\User::find($ipBilling->created_by_id);

        return view("pharmacy.ip-pharmacy-indent-billing-receipt", compact("ipBilling", "totalAmount", "totaldDiscount", "discountedAmount", "createdBy"));
    }

    public function ip_service_billing_print($bill_id)
    {
        $ip_service_billing = IpServiceBilling::findOrFail($bill_id);

        //total amount
        $totalAmount = number_format(($ip_service_billing->billing_items->sum('total')), 2, '.', ',');
        //total taxabale amount
        $totaldDiscount = number_format(($ip_service_billing->billing_items->sum('discount')), 2, '.', ',');

        $discountedAmount = ($ip_service_billing->billing_items->sum('total')) - ($ip_service_billing->billing_items->sum('discount'));
        $createdBy = \App\Models\User::find($ip_service_billing->created_by_id);

        return view("front-desk.ip-service-indent-billing-receipt", compact("ip_service_billing", "totalAmount", "totaldDiscount", "discountedAmount", "createdBy"));
    }

    public function ip_in_patient_pre_refund_print($id)
    {
        $ip_pre_refund = IpPreRefund::findOrFail($id);

        if ($ip_pre_refund) {
            return view("front-desk.ip-in-patient-pre-refund.pre-refund-receipt", compact("ip_pre_refund"));
        }

        return abort(404);
    }

    public function ip_final_bill_print($id)
    {
        $ip_final_bill = IpFinalBilling::findOrFail($id);

        if ($ip_final_bill) {
            return view("front-desk.ip-final-billing.ip-final-bill-receipt", compact("ip_final_bill"));
        }

        return abort(404);
    }

    public function ip_discharge_print($id)
    {
        $ip_discharge = IpDischarge::findOrFail($id);
        if ($ip_discharge) {
            return view("front-desk.ip-discharge.ip-discharge-receipt", compact("ip_discharge"));
        }

        return abort(404);
    }
}

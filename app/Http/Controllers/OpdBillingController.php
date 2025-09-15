<?php

namespace App\Http\Controllers;

use App\Models\OpdBilling;
use App\Models\OpdBillingDiscount;
use App\Models\ServiceDue;
use Illuminate\Http\Request;

class OpdBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function print($opd_billing_id)
    {

        $opdBilling = OpdBilling::find($opd_billing_id);
        // $opdBillingItems=$opdBilling->opdBillingItems;
        // dd($opdBillingItems);
        //total amount
        $totalAmount = number_format(($opdBilling->opdBillingItems->where('is_cancled', '0')->sum('amount')), 2, '.', ',');
        //total taxabale amount
        $totaldDiscount = number_format(($opdBilling->opdBillingItems->where('is_cancled', '0')->sum('discount')), 2, '.', ',');

        $discountedAmount = ($opdBilling->opdBillingItems->where('is_cancled', '0')->sum('amount')) - ($opdBilling->opdBillingItems->where('is_cancled', '0')->sum('discount'));
        $createdBy = \App\Models\User::find($opdBilling->created_by_id)->first();


        return view("admin.opd-billing.receipt", compact("opdBilling", "totalAmount", "totaldDiscount", "discountedAmount", "createdBy"));
    }

    public function print_overall_discount($opd_billing_id)
    {

        $opdBilling = OpdBilling::find($opd_billing_id);
        // $opdBillingItems=$opdBilling->opdBillingItems;
        // dd($opdBillingItems);
        //total amount
        $totalAmount = number_format(($opdBilling->opdBillingItems->sum('amount')), 2, '.', ',');
        //total taxabale amount
        $opd_billing_discount = OpdBillingDiscount::where('opd_billing_id', $opd_billing_id)->first();

        $totaldDiscount = number_format(($opd_billing_discount->discount), 2, '.', ',');

        $discountedAmount = (float)$opdBilling->opdBillingItems->sum('amount') - (float)$opd_billing_discount->discount;

        $createdBy = \App\Models\User::find($opdBilling->created_by_id)->first();


        return view("admin.opd-billing.receipt", compact("opdBilling", "totalAmount", "totaldDiscount", "discountedAmount", "createdBy"));
    }
    public function print_osp($opd_billing_id)
    {

        $opdBilling = OpdBilling::find($opd_billing_id);
        return view("admin.opd-billing.receipt-osp", compact("opdBilling"));
    }
    public function index()
    {
        $opdBillings = OpdBilling::orderBy("created_at", "desc")->get();
        return view("admin.opd-billing.index", compact("opdBillings"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OpdBilling $opdBilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpdBilling $opdBilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OpdBilling $opdBilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpdBilling $opdBilling)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\OutSidePatient;
use Illuminate\Http\Request;
use App\Models\RoleStockPoint;
use App\Models\OpdMedicineReceipt;
use Illuminate\Support\Facades\Auth;

class OpdMedicineReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function print($opd_medicine_receipt_id)
    {
        //dd($opd_medicine_receipt_id);
        $opdMedicineReceipt = OpdMedicineReceipt::find($opd_medicine_receipt_id);
        // dd($opdMedicineReceipt);
        //total amount
        $totalAmount = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('amount')), 2, '.', ',');
        //total taxabale amount
        $totalTaxableAmount = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('taxable_amount')), 2, '.', ',');
        //total cgst
        $totalCgst = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('cgst')), 2, '.', ',');
        //total sgst
        $totalSgst = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('sgst')), 2, '.', ',');
        //total
        $total = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('total')), 2, '.', ',');

        return view("admin.opd-medicine-receipt.receipt", compact("opdMedicineReceipt", "totalAmount", "totalTaxableAmount", "totalCgst", "totalSgst", "total"));
    }
    public function print_osp($opd_medicine_receipt_id)
    {
        //first retrive OutSidePatient

        //dd($opd_medicine_receipt_id);
        $opdMedicineReceipt = OpdMedicineReceipt::find($opd_medicine_receipt_id);
        $outSidePatient = OutSidePatient::where('id', $opdMedicineReceipt->out_side_patient_id)->first();
        // dd($opdMedicineReceipt);
        //total amount
        $totalAmount = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('amount')), 2, '.', ',');
        //total taxabale amount
        $totalTaxableAmount = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('taxable_amount')), 2, '.', ',');
        //total cgst
        $totalCgst = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('cgst')), 2, '.', ',');
        //total sgst
        $totalSgst = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('sgst')), 2, '.', ',');
        //total
        $total = number_format(($opdMedicineReceipt->opdmedicinetransactions->sum('total')), 2, '.', ',');

        return view("admin.opd-medicine-receipt.osp-receipt", compact("opdMedicineReceipt", "totalAmount", "totalTaxableAmount", "totalCgst", "totalSgst", "total", "outSidePatient"));
    }
    public function index()
    {
        $opdMedicineReceipts = OpdMedicineReceipt::get();
        return view('admin.opd-medicine-receipt.index', compact('opdMedicineReceipts'));
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
    public function show(OpdMedicineReceipt $opdMedicineReceipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OpdMedicineReceipt $opdMedicineReceipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OpdMedicineReceipt $opdMedicineReceipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OpdMedicineReceipt $opdMedicineReceipt)
    {
        //
    }
}

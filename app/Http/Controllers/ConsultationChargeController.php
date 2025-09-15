<?php

namespace App\Http\Controllers;

use App\Models\ConsultationCharge;
use Illuminate\Http\Request;

class ConsultationChargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultationCharges = ConsultationCharge::get();
        return view("admin.consultation-charge.index", compact("consultationCharges"));
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
    public function show(ConsultationCharge $consultationCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ConsultationCharge $consultationCharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ConsultationCharge $consultationCharge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ConsultationCharge $consultationCharge)
    {
        //
    }
}

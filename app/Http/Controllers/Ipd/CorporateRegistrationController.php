<?php

namespace App\Http\Controllers\Ipd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ipd\CorporateRegistration;

class CorporateRegistrationController extends Controller
{

    public function print($id)
    {
        $corporate_registration = CorporateRegistration::find($id);

        if ($corporate_registration && $corporate_registration->is_cancelled == 0) {
            return view('admin.ipd.corporate-registration.print', compact('corporate_registration'));
        } else {
            return abort(404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(CorporateRegistration $corporateRegistration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CorporateRegistration $corporateRegistration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CorporateRegistration $corporateRegistration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CorporateRegistration $corporateRegistration)
    {
        //
    }
}

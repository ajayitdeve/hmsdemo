<?php

namespace App\Http\Controllers;

use App\Models\ConsultationCharge;
use App\Models\IdType;
use App\Models\Patient;
use App\Http\Requests\StorePatientRequest;
use App\Http\Requests\UpdatePatientRequest;
use App\Models\PatientVisit;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function book_consultation($patient_id)
    {
        $patient = Patient::where('id', $patient_id)->first();
        return $patient_id;
    }
    public function index()
    {
        //
    }

    public function print_receipt($patient_visit_id)
    {
        //return $patient_visit_id;
        $patient_visit = PatientVisit::where('id', $patient_visit_id)->orderBy('id', 'Desc')->first();
        //dd($patient_visit);
        //getting Id Card Details like Adhar Card Pmjay etc to print on priscription
        $patient = Patient::where('id', $patient_visit->patient_id)->first();

        if ($patient->id_type_id != 0 || $patient->id_type_id != null) {
            $idType = IdType::find($patient->id_type_id);
        } else {
            $idType = null;
        }
        return view('admin.patient.receipt.opd', ['patientvisit' => $patient_visit, 'idType' => $idType, 'patient' => $patient]);
    }
    /**
     * Show the form for creating a new resource.
     */

    public function print_consultation_charge($patient_visit_id)
    {
        $patient_visit = PatientVisit::where('id', $patient_visit_id)->orderBy('id', 'Desc')->first();
        $consultation_charge = ConsultationCharge::where('id', $patient_visit_id)->first();
        //dd($patient_visit);
        return view('admin.patient.receipt.print-consultation-charge', ['patientvisit' => $patient_visit, 'consultation_charge' => $consultation_charge]);
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePatientRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\PatientVisit;
use Illuminate\Http\Request;

class PatientVisitController extends Controller
{
    public function doctor_wise_consultation()
    {
        $doctors = Doctor::all();

        $data = [];

        foreach ($doctors as $doctor) {
            $consultationCount = PatientVisit::where('doctor_id', $doctor->id)->count();
            $temp = [];
            $temp['id'] = $doctor->id;
            $temp['name'] = $doctor->name;
            $temp['consultation_count'] = $consultationCount;
            $temp['department'] = $doctor->department->name;
            array_push($data, $temp);
        }
        return view('admin.patient-visit.doctor-wise-consultation', ['data' => $data]);
    }

    public function doctor_wise_consultation_list(Request $request)
    {
        $doctor = Doctor::where('id', $request->doctor_id)->first();
        $patientvisits = PatientVisit::where('doctor_id', $request->doctor_id)->get();
        return view('admin.patient-visit.doctor-wise-consultation-list', ['patientvisits' => $patientvisits, 'doctor' => $doctor]);
    }
}

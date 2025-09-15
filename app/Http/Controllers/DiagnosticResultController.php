<?php

namespace App\Http\Controllers;

use App\Models\Pathology\DiagnosticResult;
use App\Models\Pathology\IpdDiagnosticResult;
use Illuminate\Http\Request;

class DiagnosticResultController extends Controller
{
    public function print_report($id)
    {
        $diagnosticResult = DiagnosticResult::find($id);
        $diagnosticResultValues = DiagnosticResult::find($id)->diagnosticResultValues;
        $ageUomArr = ['1' => 'Year', '2' => 'Month', '3' => 'Day', '4' => 'Hour', '5' => 'Minute', '6' => 'Second'];

        //  dd($diagnosticResult);
        //  dd($diagnosticResultValues);
        //preparing Remarks
        $reamarksArr = [];
        foreach ($diagnosticResultValues as $diagnosticResultValue) {
            $temp = [];
            foreach ($diagnosticResultValue->parameter->parameterValues as $parameterValue) {
                $temp2 = [];
                $minAge = $parameterValue->parameter->min_age != null ? $parameterValue->parameter->min_age : null;
                $minAgeUom = $parameterValue->parameter->min_age_uom != null ? $parameterValue->parameter->min_age_uom : null;
                $maxAge = $parameterValue->parameter->max_age != null ? $parameterValue->parameter->max_age : null;
                $maxAgeUom = $parameterValue->parameter->max_age_uom != null ? $parameterValue->parameter->max_age_uom : null;
                $temp2 = [
                    'parameter_id' => $parameterValue->parameter_id,
                    'name' => $parameterValue->parameter->code,
                    'code' => $parameterValue->parameter->code,
                    'min_age' => ($minAge != null && $minAgeUom != null) ? $minAge : null,
                    'min_age_uom' => $minAgeUom != null ? $ageUomArr["'" . $minAgeUom . "'"] : null,
                    'max_age' => ($maxAge != null && $maxAgeUom != null) ? $maxAge : null,
                    'max_age_uom' => $maxAgeUom != null ? $ageUomArr["'" . $maxAgeUom . "'"] : null,
                    'gender' => ($parameterValue->parameter->gender_id != null ? ($parameterValue->parameter->gender_id == 1 ? 'Male' : 'Female') : null),
                    'symbol' => $parameterValue->symbol != null ? $parameterValue->symbol->name : null,
                    'noraml_range' => $parameterValue->normal_range != null ? $parameterValue->normal_range : null,
                    'min_critical' => $parameterValue->min_critical != null ? $parameterValue->min_critical : null,
                    'max_critical' => $parameterValue->max_critical != null ? $parameterValue->max_critical : null,

                ];
                //  $temp[$parameterValue->parameter] = $temp2;
                array_push($reamarksArr, $temp2);
            }
            //    array_push($reamarksArr, $temp);

        }
        // dd($reamarksArr);
        return view('admin.pathology.diagnostic-result', ['diagnosticResult' => $diagnosticResult, 'diagnosticResultValues' => $diagnosticResultValues, 'reamarksArr' => $reamarksArr]);
    }

    public function print_ipd_diagnostic_report($id)
    {
        $diagnosticResult = IpdDiagnosticResult::find($id);
        $diagnosticResultValues = $diagnosticResult->diagnosticResultValues;
        $ageUomArr = ['1' => 'Year', '2' => 'Month', '3' => 'Day', '4' => 'Hour', '5' => 'Minute', '6' => 'Second'];

        //  dd($diagnosticResultValues);
        //preparing Remarks
        $reamarksArr = [];
        foreach ($diagnosticResultValues as $diagnosticResultValue) {
            $temp = [];
            foreach ($diagnosticResultValue->parameter->parameterValues as $parameterValue) {
                $temp2 = [];
                $minAge = $parameterValue->parameter->min_age != null ? $parameterValue->parameter->min_age : null;
                $minAgeUom = $parameterValue->parameter->min_age_uom != null ? $parameterValue->parameter->min_age_uom : null;
                $maxAge = $parameterValue->parameter->max_age != null ? $parameterValue->parameter->max_age : null;
                $maxAgeUom = $parameterValue->parameter->max_age_uom != null ? $parameterValue->parameter->max_age_uom : null;
                $temp2 = [
                    'parameter_id' => $parameterValue->parameter_id,
                    'name' => $parameterValue->parameter->code,
                    'code' => $parameterValue->parameter->code,
                    'min_age' => ($minAge != null && $minAgeUom != null) ? $minAge : null,
                    'min_age_uom' => $minAgeUom != null ? $ageUomArr["'" . $minAgeUom . "'"] : null,
                    'max_age' => ($maxAge != null && $maxAgeUom != null) ? $maxAge : null,
                    'max_age_uom' => $maxAgeUom != null ? $ageUomArr["'" . $maxAgeUom . "'"] : null,
                    'gender' => ($parameterValue->parameter->gender_id != null ? ($parameterValue->parameter->gender_id == 1 ? 'Male' : 'Female') : null),
                    'symbol' => $parameterValue->symbol != null ? $parameterValue->symbol->name : null,
                    'noraml_range' => $parameterValue->normal_range != null ? $parameterValue->normal_range : null,
                    'min_critical' => $parameterValue->min_critical != null ? $parameterValue->min_critical : null,
                    'max_critical' => $parameterValue->max_critical != null ? $parameterValue->max_critical : null,

                ];

                array_push($reamarksArr, $temp2);
            }
        }

        return view('admin.pathology.ipd-diagnostic-result', ['diagnosticResult' => $diagnosticResult, 'diagnosticResultValues' => $diagnosticResultValues, 'reamarksArr' => $reamarksArr]);
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
    public function show(DiagnosticResult $diagnosticResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiagnosticResult $diagnosticResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DiagnosticResult $diagnosticResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DiagnosticResult $diagnosticResult)
    {
        //
    }
}

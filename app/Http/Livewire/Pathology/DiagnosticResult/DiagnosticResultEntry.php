<?php

namespace App\Http\Livewire\Pathology\DiagnosticResult;

use App\Models\Pathology\DiagnosticResultValue;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\OpdBilling;
use App\Models\Service\Service;
use App\Models\Pathology\DiagnosticResult;
use Illuminate\Support\Facades\Auth;

class DiagnosticResultEntry extends Component
{
    public $opd_billing_code, $patient_type, $umr, $name, $gender, $age, $gender_age, $opdBilling, $status = false, $opdBillingItems = [], $lab_no = null, $sampleDone = [];
    public $selectedServiceId = null, $selectedService;
    public $result_value = [], $diagnosticResultArr = [];


    public $diagnostic_result_value_id = null, $parameter_result_value = null;
    public function mount()
    {
        $this->lab_no = $this->generateLabNo();
    }
    public function opdBillingCodeChanged()
    {
        // dd('bill changed');
        $this->status = true;
        $this->opdBilling = OpdBilling::where('code', $this->opd_billing_code)->first();
        $this->patient_type = $this->opdBilling->patient_type;
        if ($this->opdBilling->out_side_patient_id != null) {
            //out side patient

            $this->gender = $this->opdBilling?->outSidePatient?->gender?->name;
            $this->age = $this->opdBilling?->outSidePatient?->age;
            $this->age = $this->opdBilling?->outSidePatient?->age;
            $this->umr = $this->opdBilling?->outSidePatient?->registration_no;
            $this->name = $this->opdBilling?->outSidePatient?->name;
        } else {
            $this->gender = $this->opdBilling?->patient?->gender?->name;
            $this->umr = $this->opdBilling?->patient?->registration_no;
            $this->age = $this->opdBilling?->patient?->age;
            $this->name = $this->opdBilling?->patient?->name;
        }
        $this->gender_age = $this->gender . ' ' . $this->age;
        $this->opdBillingItems = $this->opdBilling->opdBillingItems;

        //setting selected service to show details of parameters
        // $this->selectedServiceId=$this->opdBillingItems->first()?->id;
        // $this->selectedService=Service::find($this->selectedServiceId)->first();
    }
    public function generateLabNo()
    {
        $currentDate = Carbon::now()->toDateString(); //ex 03-07-2024
        $count = \App\Models\Pathology\SampleCollection::whereDate('created_at', date('Y-m-d', strtotime($currentDate)))->count();
        return date('y') . date('m') . date('d') . ((int) $count + 1);
    }

    public function serviceSelected($id)
    {

        $this->selectedServiceId = $id;
        $x = Service::find($id);
        $this->selectedService = $x;


        // dd($x->format->formatParameters);
    }
    public function save()
    {
        // $maxId = DiagnosticResult::max('id');
        // $code = 'RES' . date('d') . date('m') . date('y') . $maxId + 1;
        // $diagnosticResult = DiagnosticResult::create([
        //     'patient_id' => $this->opdBilling->patient_id,
        //     'patient_visit_id' => $this->opdBilling->patient_visit_id,
        //     'out_side_patient_id' => $this->opdBilling->out_side_patient_id,
        //     'doctor_id' => 1,
        //     'code'=>$code,
        //     'patient_type' => $this->opdBilling->patient_type,
        //     'sample_collection_id' => $this->opdBilling->sampleCollection->id,
        //     'opd_billing_id' => $this->opdBilling->id,
        //     'ref_no' => $this->opdBilling->out_side_patient_id != null ? $this->opdBilling->outSidePatient->registration_no : $this->opdBilling->patient->registration_no,
        //     'status' => false,
        //     'result_date' => Carbon::now()->toDateTimeString(),
        //     'created_by_id' => Auth::user()?->id,
        //     'updated_by_id' => Auth::user()?->id,
        //     'approved_by_id' => null,
        // ]);

    }
    public function saveResult()
    {

        //first check DiagnosticResult exist or not
        $diagnosticResult = DiagnosticResult::where('opd_billing_id', $this->opdBilling->id)->first();
        if ($diagnosticResult != null) {
            //if DiagnosticResult exist
            //updating the existing values
            //first get the all entries by current diagnostic_result_id and servive_id
            $currentDiagnosticResultValuesByService = $diagnosticResult->diagnosticResultValues->where('service_id', $this->selectedServiceId);
            //dd($currentDiagnosticResultValuesByService);
        } else {
            //new diagnosticResult
            $maxId = DiagnosticResult::max('id');
            $code = 'RES' . date('d') . date('m') . date('y') . $maxId + 1;
            $diagnosticResult = [];
            //for normal patient having UMR
            if ($this->opdBilling->out_side_patient_id == null) {
                $diagnosticResult = DiagnosticResult::create([
                    'patient_id' => $this->opdBilling->patient_id,
                    'patient_visit_id' => $this->opdBilling->patient_visit_id,
                    'out_side_patient_id' => null,
                    'doctor_id' => 6,
                    'code' => $code,
                    'sample_collection_id' => $this->opdBilling->sampleCollection->id,
                    'opd_billing_id' => $this->opdBilling->id,
                    'ref_no' => $this->opdBilling->patient->registration_no,
                    'patient_type' => $this->patient_type,
                    'status' => false,
                    'result_date' => Carbon::now()->toDateTimeString()
                ]);
            } else {
                //for out side patient
                $maxId = DiagnosticResult::max('id');
                $code = 'RES' . date('d') . date('m') . date('y') . $maxId + 1;
                $diagnosticResult = DiagnosticResult::create([
                    'patient_id' => null,
                    'patient_visit_id' => null,
                    'out_side_patient_id' => $this->opdBilling->out_side_patient_id,
                    'doctor_id' => 1,
                    'code' => $code,
                    'sample_collection_id' => $this->opdBilling->sampleCollection->id,
                    'opd_billing_id' => $this->opdBilling->id,
                    'ref_no' => $this->opdBilling->outSidePatient->registration_no,
                    'patient_type' => $this->patient_type,
                    'status' => false,
                    'result_date' => Carbon::now()->toDateTimeString(),
                ]);
            }
            $diagnosticResultCart = new \App\Services\DiagnosticResultCart($this->opdBilling->id, $this->selectedService->id, $this->result_value);
            $myArr = [];
            //pushing data in diagnostic_result_values
            foreach ($diagnosticResultCart->result_value as $key => $value) {
                $temp = [];
                $temp['diagnostic_result_id'] = $diagnosticResult->id;
                $temp['parameter_id'] = $key;
                $temp['result_value'] = $value;
                $temp['service_id'] = $this->selectedService->id;

                array_push($myArr, $temp);
            }
            $diagnosticResultEntry = \App\Models\Pathology\DiagnosticResultValue::insert($myArr);
            session()->flash('message', 'Result Value Saved Successfully.');
            //dd($myArr);

        }
    }

    public function isParameterExist($parameter_id, $arr)
    {
        $count = 0;
        foreach ($arr as $myArr) {
            if ($myArr["parameter_id"] == $parameter_id) {
                $count++;
            }
            return $count;
        }
    }
    public function addToCart($parameter_id)
    {



        $diagnosticResultCart = new \App\Services\DiagnosticResultCart($this->opdBilling->id, $this->selectedService->id, $this->result_value);

        $temp = [];

        $temp['service_id'] = $diagnosticResultCart->service_id;
        $temp['opd_billing_id'] = $diagnosticResultCart->opd_billing_id;
        $temp['result_value'] = $diagnosticResultCart->result_value;
        $this->diagnosticResultArr = [];
        array_push($this->diagnosticResultArr, $temp);



        // dd($diagnosticResultCart);
        //reseting form
        //$this->reset('parameter_id', 'sub_title');

    }


    public function edit(int $diagnostic_result_value_id)
    {
        $diagnosticResultValue = DiagnosticResultValue::find($diagnostic_result_value_id);
        if ($diagnosticResultValue) {
            $this->diagnostic_result_value_id = $diagnostic_result_value_id;
            $this->result_value = $diagnosticResultValue->result_value;;
        } else {
        }
    }

    public function update()
    {

        DiagnosticResultValue::where('id',   $this->diagnostic_result_value_id)->update(['result_value' => $this->result_value]);
        session()->flash('message', 'Updated Successfully.');
        $this->result_value = null;
        $this->dispatchBrowserEvent('close-modal');
    }

    public function closeModal() {}

    public function render()
    {
        return view('livewire.pathology.diagnostic-result.diagnostic-result-entry')->extends('layouts.admin')->section('content');
    }
}

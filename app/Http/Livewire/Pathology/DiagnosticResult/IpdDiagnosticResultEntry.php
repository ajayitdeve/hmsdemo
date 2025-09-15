<?php

namespace App\Http\Livewire\Pathology\DiagnosticResult;

use App\Models\IpServiceBilling;
use App\Models\Pathology\IpdDiagnosticResult;
use App\Models\Pathology\IpdDiagnosticResultValue;
use App\Models\Pathology\IpdSampleCollection;
use App\Models\Service\Service;
use Carbon\Carbon;
use Livewire\Component;

class IpdDiagnosticResultEntry extends Component
{
    public $patient_type, $umr, $name, $gender, $age, $gender_age, $opdBilling, $status = false, $opdBillingItems = [], $lab_no = null, $sampleDone = [];
    public $selectedServiceId, $selectedService;
    public $result_value = [], $diagnosticResultArr = [];

    public $diagnostic_result_value_id = null, $parameter_result_value = null;

    public $ipd_service_billing_id, $diagnostic_result;
    public $ipd_billing_items;
    public $ipd_service_billing, $ipd_service_billing_list = [];

    public function mount()
    {
        $this->lab_no = $this->generateLabNo();
        $this->ipd_service_billing_list = IpServiceBilling::latest()->get();
    }

    public function generateLabNo()
    {
        $currentDate = Carbon::now()->toDateString();
        $count = IpdSampleCollection::whereDate('created_at', date('Y-m-d', strtotime($currentDate)))->count();

        return date('y') . date('m') . date('d') . ((int) $count + 1);
    }

    public function ipdBillingChanged()
    {
        $ipd_service_billing = IpServiceBilling::where('id', $this->ipd_service_billing_id)->first();
        if ($ipd_service_billing) {
            $this->ipd_service_billing = $ipd_service_billing;
            $this->status = true;

            $patient = $this->ipd_service_billing?->patient;

            $this->gender = $patient?->gender?->name;
            $this->umr = $patient?->registration_no;
            $this->age = $patient?->age;
            $this->name = $patient?->name;
            $this->gender_age = $this->gender . ' ' . $this->age;

            $this->ipd_billing_items = $this->ipd_service_billing?->billing_items;
        }
    }

    public function serviceSelected($id)
    {
        $this->selectedServiceId = $id;
        $x = Service::find($id);
        $this->selectedService = $x;

        $diagnostic_result = IpdDiagnosticResult::where('ip_service_billing_id', $this->ipd_service_billing_id)->first();
        if ($diagnostic_result) {
            $this->diagnostic_result = $diagnostic_result;
        }
    }

    public function saveResult()
    {
        //first check DiagnosticResult exist or not
        $diagnosticResult = IpdDiagnosticResult::where('ip_service_billing_id', $this->ipd_service_billing_id)->first();
        if ($diagnosticResult != null) {
            //if DiagnosticResult exist
            //updating the existing values
            //first get the all entries by current diagnostic_result_id and servive_id
            $currentDiagnosticResultValuesByService = $diagnosticResult->diagnosticResultValues->where('service_id', $this->selectedServiceId);
            //dd($currentDiagnosticResultValuesByService);
        } else {
            // New diagnosticResult
            $maxId = IpdDiagnosticResult::max('id');
            $code = 'RES' . date('d') . date('m') . date('y') . $maxId + 1;

            // For normal patient having UMR
            $diagnosticResult = IpdDiagnosticResult::create([
                'patient_id' => $this->ipd_service_billing->patient_id,
                'patient_visit_id' => $this->ipd_service_billing?->patient?->patientvisits()->latest()->first()?->id,
                'doctor_id' => 6,
                'ipd_sample_collection_id' => $this->ipd_service_billing?->ipd_sample_collection?->id,
                'ip_service_billing_id' => $this->ipd_service_billing_id,
                'ref_no' => $this->ipd_service_billing?->patient?->registration_no,
                'code' => $code,
                'status' => false,
                'result_date' => Carbon::now()->toDateTimeString()
            ]);

            $myArr = [];
            //pushing data in diagnostic_result_values
            foreach ($this->result_value as $key => $value) {
                $temp = [];
                $temp['ipd_diagnostic_result_id'] = $diagnosticResult->id;
                $temp['parameter_id'] = $key;
                $temp['result_value'] = $value;
                $temp['service_id'] = $this->selectedService?->id;

                array_push($myArr, $temp);
            }

            IpdDiagnosticResultValue::insert($myArr);
            session()->flash('message', 'Result Value Saved Successfully.');
        }
    }

    public function edit(int $diagnostic_result_value_id)
    {
        $diagnosticResultValue = IpdDiagnosticResultValue::find($diagnostic_result_value_id);
        if ($diagnosticResultValue) {
            $this->diagnostic_result_value_id = $diagnostic_result_value_id;
            $this->result_value = $diagnosticResultValue->result_value;;
        }
    }

    public function update()
    {
        IpdDiagnosticResultValue::where('id',   $this->diagnostic_result_value_id)->update(['result_value' => $this->result_value]);
        session()->flash('message', 'Updated Successfully.');
        $this->result_value = null;
        $this->dispatchBrowserEvent('close-modal');

        $diagnostic_result = IpdDiagnosticResult::where('ip_service_billing_id', $this->ipd_service_billing_id)->first();
        if ($diagnostic_result) {
            $this->diagnostic_result = $diagnostic_result;
        }
    }

    public function closeModal() {}

    public function render()
    {
        return view('livewire.pathology.diagnostic-result.ipd-diagnostic-result-entry')->extends('layouts.admin')->section('content');
    }
}

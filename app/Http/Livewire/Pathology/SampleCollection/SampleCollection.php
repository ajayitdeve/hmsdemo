<?php

namespace App\Http\Livewire\Pathology\SampleCollection;


use Carbon\Carbon;
use Livewire\Component;
use App\Models\OpdBilling;
use Illuminate\Support\Facades\Auth;

class SampleCollection extends Component
{
    public $opd_billing_code, $patient_type, $umr, $name, $gender, $age, $gender_age, $opdBilling, $status = false, $opdBillingItems = [], $lab_no = null, $sampleDone = [];
    public $sample_done = false;
    public $sampleCollectionAlredyExist = false, $existingSampleCollection = [];
    public function mount()
    {
        $this->lab_no = $this->generateLabNo();
    }
    public function opdBillingCodeChanged()
    {
        $opdBilling = OpdBilling::where('code', $this->opd_billing_code)->first();

        if ($opdBilling) {
            $searchedOpdBillingId = $opdBilling->id;

            $sampleCollectionCount = \App\Models\Pathology\SampleCollection::where('opd_billing_id', $searchedOpdBillingId)->count();

            if ($sampleCollectionCount) {
                $this->existingSampleCollection = \App\Models\Pathology\SampleCollection::where('opd_billing_id', $searchedOpdBillingId)->first();
                $this->sampleCollectionAlredyExist = true;
                //dd($this->existingSampleCollection);
            }
            // dd('bill changed');
            $this->status = true;
            $this->opdBilling = OpdBilling::where('code', $this->opd_billing_code)->first();
            $this->patient_type = $this->opdBilling->patient_type;
            if ($this->opdBilling->out_side_patient_id != null) {
                //out side patient

                $this->gender = $this->opdBilling->outSidePatient->gender->name;
                $this->age = $this->opdBilling->outSidePatient->age;
                $this->age = $this->opdBilling->outSidePatient->age;
                $this->umr = $this->opdBilling->outSidePatient->registration_no;
                $this->name = $this->opdBilling->outSidePatient->name;
            } else {
                $this->gender = $this->opdBilling->patient->gender->name;
                $this->umr = $this->opdBilling->patient->registration_no;
                $this->age = $this->opdBilling->patient->age;
                $this->name = $this->opdBilling->patient->name;
            }
            $this->gender_age = $this->gender . ' ' . $this->age;
            $this->opdBillingItems = $this->opdBilling->opdBillingItems;
        } else {

            session()->flash('error', "Opd Billing not found");
        }
    }
    public function generateLabNo()
    {
        $currentDate = Carbon::now()->toDateString(); //ex 03-07-2024
        $count = \App\Models\Pathology\SampleCollection::whereDate('created_at', date('Y-m-d', strtotime($currentDate)))->count();
        return date('y') . date('m') . date('d') . ((int) $count + 1);
    }
    public function save()
    {

        //before save first check sampleDone array is not blank

        if (count($this->sampleDone) > 0) {
        } else {
            session()->flash('error', "Select at least one sample");
            return;
        }
        $searchedOpdBillingId = OpdBilling::where('code', $this->opd_billing_code)->first()?->id;

        $sampleCollectionCount = \App\Models\Pathology\SampleCollection::where('opd_billing_id', $searchedOpdBillingId)->count();
        if ($sampleCollectionCount) {
            $this->existingSampleCollection = \App\Models\Pathology\SampleCollection::where('opd_billing_id', $searchedOpdBillingId)->first();
            $this->sampleCollectionAlredyExist = true;

            foreach ($this->sampleDone as $key => $value) {
                if ($value) {
                    //get the SampleCollectionItem where service is equal to $key
                    foreach ($this->existingSampleCollection->sampleCollectionItems as $sampleCollectionItem) {
                        if ($sampleCollectionItem->opdBillingItem->service->id == $key) {
                            $sampleCollectionItem->update(['sample_done' => $value]);
                        }
                    }
                }
            }
        } else {


            //first pushing data in sample collection
            //'opd_billing_id', 'code', 'lab_no', 'sample_entry_date', 'created_by_id', 'updated_by_id', 'approved_by_id'
            $sampleCollectionMaxId = \App\Models\Pathology\SampleCollection::max('id');
            $sampleCollectionCode = 'SO' . $sampleCollectionMaxId + 1;
            $sampleCollection = \App\Models\Pathology\SampleCollection::create([
                'opd_billing_id' => $this->opdBilling->id,
                'code' => $sampleCollectionCode,
                'lab_no' => $this->generateLabNo(),
                'sample_entry_date' => Carbon::now()->toDateTimeString(),
                'created_by_id' => Auth::user()?->id,
                'updated_by_id' => null,
                'approved_by_id' => null
            ]);

            // dd($this->sampleDone);
            //pushing data in sample collection items
            //'sample_collection_id', 'opd_billing_items_id', 'sample_done'
            $data = [];
            $i = 0;
            foreach ($this->opdBilling->opdBillingItems as $opdBillingItem) {
                $temp = [];
                $temp['sample_collection_id'] = $sampleCollection->id;
                $temp['opd_billing_items_id'] = $opdBillingItem->id;
                $temp['sample_done'] = array_key_exists($opdBillingItem->service->id, $this->sampleDone) ? $this->sampleDone[$opdBillingItem->service->id] : false;
                $temp['created_at'] = Carbon::now()->toDateTimeString();
                $temp['updated_at'] = Carbon::now()->toDateTimeString();
                array_push($data, $temp);
            }
            //dd($data);

            $sampleCollectionItem = \App\Models\Pathology\SampleCollectionItem::insert($data);

            session()->flash('success', "Sample Collection Saved Successfully");
            $this->opdBillingCodeChanged();
        }
    }
    public function render()
    {
        return view('livewire.pathology.sample-collection.sample-collection')->extends('layouts.admin')->section('content');
    }
}

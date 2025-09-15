<?php

namespace App\Http\Livewire\Pathology\Ipd;

use App\Models\IpServiceBilling;
use App\Models\Pathology\IpdSampleCollection as SampleCollection;
use App\Models\Pathology\IpdSampleCollectionItem;
use Carbon\Carbon;
use Livewire\Component;

class IpdSampleCollection extends Component
{

    public $ipd_service_billing_id, $umr, $name, $gender, $age, $gender_age, $status = false, $lab_no;

    public $sampleCollectionAlredyExist = false, $existingSampleCollection = [];
    public $sampleDone = [], $sample_done = false;

    public $ipd_service_billing;
    public $ipd_billing_items = [];
    public $ipd_service_billing_list = [];

    public function mount()
    {
        $this->lab_no = $this->generateLabNo();
        $this->ipd_service_billing_list = IpServiceBilling::latest()->get();
    }

    public function generateLabNo()
    {
        $currentDate = Carbon::now()->toDateString();
        $count = SampleCollection::whereDate('created_at', date('Y-m-d', strtotime($currentDate)))->count();
        return date('y') . date('m') . date('d') . ((int) $count + 1);
    }

    public function ipdBillingChanged()
    {
        $ipdBilling = IpServiceBilling::where('id', $this->ipd_service_billing_id)->first();

        if ($ipdBilling) {
            $this->ipd_service_billing = $ipdBilling;

            $sampleCollection = SampleCollection::where('ip_service_billing_id', $ipdBilling->id)->first();

            if ($sampleCollection) {
                $this->existingSampleCollection = $sampleCollection;
                $this->sampleCollectionAlredyExist = true;
            }

            $this->status = true;
            $patient = $this->ipd_service_billing?->patient;

            $this->gender = $patient?->gender?->name;
            $this->umr = $patient?->registration_no;
            $this->age = $patient?->age;
            $this->name = $patient?->name;
            $this->gender_age = $this->gender . ' ' . $this->age;

            $this->ipd_billing_items = $this->ipd_service_billing?->billing_items;
        } else {
            session()->flash('error', "IPD billing not found..");
        }
    }

    public function save()
    {
        if (count($this->sampleDone) > 0) {
            $sampleCollection = SampleCollection::where('ip_service_billing_id', $this->ipd_service_billing_id)->first();

            if ($sampleCollection) {
                $this->existingSampleCollection = $sampleCollection;
                $this->sampleCollectionAlredyExist = true;

                foreach ($this->sampleDone as $key => $value) {
                    if ($value) {
                        //get the SampleCollectionItem where service is equal to $key
                        foreach ($sampleCollection?->sample_collection_items as $sample_collection_item) {
                            if ($sample_collection_item->ipd_billing_item->service->id == $key) {
                                $sample_collection_item->update(['sample_done' => $value]);
                            }
                        }
                    }
                }
            } else {
                $sampleCollectionMaxId = SampleCollection::max('id');
                $sampleCollectionCode = 'SO' . $sampleCollectionMaxId + 1;

                $sampleCollection = SampleCollection::create([
                    'ip_service_billing_id' => $this->ipd_service_billing_id,
                    'code' => $sampleCollectionCode,
                    'lab_no' => $this->generateLabNo(),
                    'sample_entry_date' => Carbon::now()->toDateTimeString(),
                    'created_by_id' => auth()->user()?->id,
                    'updated_by_id' => null,
                    'approved_by_id' => null
                ]);

                $data = [];
                foreach ($this->ipd_service_billing->billing_items as $billing_items) {
                    $temp = [];
                    $temp['ipd_sample_collection_id'] = $sampleCollection->id;
                    $temp['ip_service_billing_item_id'] = $billing_items->id;
                    $temp['sample_done'] = array_key_exists($billing_items->service->id, $this->sampleDone) ? $this->sampleDone[$billing_items->service->id] : false;
                    $temp['created_at'] = Carbon::now()->toDateTimeString();
                    $temp['updated_at'] = Carbon::now()->toDateTimeString();
                    array_push($data, $temp);
                }

                IpdSampleCollectionItem::insert($data);

                session()->flash('success', "IPD Sample Collection Saved Successfully");

                $this->ipdBillingChanged();
            }
        } else {
            session()->flash("error", 'Select at least one sample');
            return;
        }
    }

    public function render()
    {
        return view('livewire.pathology.ipd.ipd-sample-collection')->extends('layouts.admin')->section('content');
    }
}

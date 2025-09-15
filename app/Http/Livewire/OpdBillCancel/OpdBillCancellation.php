<?php

namespace App\Http\Livewire\OpdBillCancel;

use App\Models\OpdBilling;
use App\Models\OpdBillingItems;
use Livewire\Component;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OpdBillCancellation extends Component
{
    //1-opd_billings  and 2- opd_billing_items
    public $name, $father_name, $doctor_name, $doctor_department, $doctor_unit, $batch_stock;
    //for cancle recipt
    public $bill_no = null, $opdBillingIteams = [], $address, $patient, $opdBilling;
    public $is_outside_patient, $registration_no;

    public $cancel_bill_id, $cancel_item_id, $reason, $approved_by, $show_cancel_button = false;
    public $users = [];

    public function mount()
    {
        $this->users = User::all();
    }

    public function billNoChanged()
    {
        $opdBilling = OpdBilling::where('code', $this->bill_no)->first();

        if ($opdBilling) {
            if ($opdBilling->is_cancled) {
                session()->flash('error', 'Alredy cancelled');
                return;
            }

            if ($opdBilling->sampleCollection) {
                session()->flash('error', 'Sample collection alredy exist');
                return;
            }

            if ($opdBilling->diagnosticResult) {
                session()->flash('error', 'Diagnostic result alredy exist');
                return;
            }


            $this->opdBilling = $opdBilling;

            if ($opdBilling) {
                $opdBilling->patient_id != null ? $this->is_outside_patient = false : $this->is_outside_patient = true;
                $opdBilling->out_side_patient_id != null ? $this->is_outside_patient = true : $this->is_outside_patient = false;
                if ($opdBilling->patient_id != null) {

                    $this->patient = Patient::find($opdBilling->patient_id);
                    //dd($this->patient);
                    //$doctor_name, $doctor_department, $doctor_unit, $batch_stock;
                    $this->name = $this->patient->name ? $this->patient->name : null;
                    $this->registration_no = $this->patient->registration_no;
                    $this->address = $this->patient->address;
                }
                if ($opdBilling->out_side_patient_id != null) {
                    $this->patient = OutSidePatient::find($opdBilling->out_side_patient_id);

                    $this->name = $this->patient->name ? $this->patient->name : null;
                    $this->father_name = $this->patient->father_name;
                    $this->registration_no = $this->patient->registration_no;
                    $this->address = $this->patient->address;
                }
            }
            $this->opdBillingIteams = OpdBillingItems::where('opd_billing_id', $opdBilling->id)->get();
            // dd($this->opdBillingIteams);
        } else {
            session()->flash('error', 'Bill not found');
        }
    }

    public function view_item_cancel($cancel_item_id, $show_cancel_button = false)
    {
        $this->reset(['cancel_item_id', 'reason', 'approved_by', 'show_cancel_button']);

        $this->cancel_item_id = $cancel_item_id;
        $item = OpdBillingItems::find($this->cancel_item_id);
        if ($item) {
            $this->reason = $item->canceled_reason;
            $this->approved_by = $item->canceled_approve_by_id;

            if ($show_cancel_button) {
                $this->show_cancel_button = true;
            }

            $this->dispatchBrowserEvent('show-cancel-modal');
        }
    }

    public function cancel()
    {
        $this->validate([
            'reason' => 'required',
            'approved_by' => 'required',
        ]);

        $item = OpdBillingItems::find($this->cancel_item_id);
        if ($item) {
            $item->is_cancled = 1;
            $item->canceled_reason = $this->reason;
            $item->canceled_approve_by_id = $this->approved_by;
            $item->canceled_by_id = auth()->user()?->id;
            $item->save();

            $this->reset(['cancel_item_id', 'reason', 'approved_by']);
            $this->billNoChanged();
            $this->dispatchBrowserEvent('hide-cancel-modal');
        }
    }

    public function confirmation()
    {
        $this->reset(['reason', 'approved_by']);

        $this->dispatchBrowserEvent('open-confirmation-modal');
    }


    public function cancel_bill()
    {
        $status = true;

        try {
            DB::beginTransaction();
            //update OpdBilling
            $opdBilling = $this->opdBilling->update([
                'is_cancled' => true,
                'cancled_reason' => $this->reason,
                'cancled_approve_by_id' => $this->approved_by,
                'cancled_date' => date('Y-m-d H:i:s'),
                'cancle_by_id' => Auth::user()?->id,
            ]);

            foreach ($this->opdBilling->opdBillingItems as $opdBillingItem) {
                $opdBillingItem->update([
                    'is_cancled' => true,
                    'canceled_reason' => $this->reason,
                    'canceled_approve_by_id' => $this->approved_by,
                    'canceled_by_id' => auth()->user()?->id,
                ]);
            }


            $status = $status && $opdBilling;
        } catch (\Exception $e) {
            DB::rollBack();
        }
        //if previous DB action are OK
        if ($status) {
            DB::commit();

            // return true;
        } else {
            DB::rollBack();

            // return false;
        }

        return redirect()->route('admin.all-opd-bill')->with('message', 'Cancelled Successfully.');
    }

    public function render()
    {
        return view('livewire.opd-bill-cancel.opd-bill-cancellation')->extends('layouts.admin')->section('content');;
    }
}

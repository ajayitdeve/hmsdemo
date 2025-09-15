<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\OpdMedicineReceipt;
use App\Models\OpdMedicineTransaction;
use App\Models\OutSidePatient;
use App\Models\Patient;
use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\PharmacyDue;
use App\Models\Rate;
use App\Models\User;
use App\Models\Inventory;
use App\Models\SaleStore;
use App\Models\RoleStockPoint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CancleMedicineSale extends Component
{
    use PharmacyStockPoint;

    public $name, $father_name, $doctor_name, $doctor_department, $doctor_unit, $batch_stock;
    //for cancle recipt
    public $bill_no = null, $opdMedicineTransacrions = [], $address, $patient, $opdPatientReceipt = [];
    public function mount()
    {
        $this->checkStockPointSession();
    }
    public function billNoChanged()
    {
        $opdPatientReceipt = OpdMedicineReceipt::where('code', $this->bill_no)->first();
        $this->opdPatientReceipt = $opdPatientReceipt;
        if ($opdPatientReceipt) {
            $opdPatientReceipt->patient_id != null ? $this->is_outside_patient = false : $this->is_outside_patient = true;
            $opdPatientReceipt->out_side_patient_id != null ? $this->is_outside_patient = true : $this->is_outside_patient = false;
            if ($opdPatientReceipt->patient_id != null) {

                $this->patient = Patient::find($opdPatientReceipt->patient_id);
                //dd($this->patient);
                //$doctor_name, $doctor_department, $doctor_unit, $batch_stock;
                $this->name = $this->patient->name ? $this->patient->name : null;
                $this->registration_no = $this->patient->registration_no;
                $this->address = $this->patient->address;
            }
            if ($opdPatientReceipt->out_side_patient_id != null) {
                $this->patient = OutSidePatient::find($opdPatientReceipt->out_side_patient_id);

                $this->name = $this->patient->name ? $this->patient->name : null;
                $this->father_name = $this->patient->father_name;
                $this->registration_no = $this->patient->registration_no;
                $this->address = $this->patient->address;
            }
        }
        $this->opdMedicineTransacrions = OpdMedicineTransaction::where('opd_medicine_receipt_id', $opdPatientReceipt->id)->get();
        //  dd($this->opdMedicineTransacrions);
    }

    public function cancle()
    {

        $status = true;
        try {
            DB::beginTransaction();
            //update OpdPatientReceipt
            $receipt = $this->opdPatientReceipt->update([
                'is_cancled' => true,
                'cancled_date' => date('Y-m-d H:i:s'),
                'cancle_by_id' => Auth::user()?->id
            ]);


            foreach ($this->opdPatientReceipt->opdmedicinetransactions as $transaction) {
                $transaction->update(['is_cancled' => true]);
            }

            //if receipt and transaction successfull or not
            $status = $status && $receipt;
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



        return redirect()->route('admin.pharmacy.pharmacy-cancle-receipt')->with('message', 'Cancelled Successfully.');
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.cancle-medicine-sale')->extends('layouts.admin')->section('content');
    }
}

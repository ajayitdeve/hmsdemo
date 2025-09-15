<?php

namespace App\Http\Livewire\OpdMedicineSale;

use App\Models\OpdMedicineReceipt;
use App\Models\OpdMedicineTransaction;
use Livewire\Component;

class PharmacyCancleTransaction extends Component
{

    public $pharmacyCancleTransactions=[];
    public function mount($id){
            $this->pharmacyCancleTransactions=OpdMedicineTransaction::where('opd_medicine_receipt_id',$id)->where('is_cancled',1)->get();
           // dd($this->pharmacyCancleTransactions);
    }
    public function render()
    {
        return view('livewire.opd-medicine-sale.pharmacy-cancle-transaction')->extends('layouts.admin')->section('content');
    }
}

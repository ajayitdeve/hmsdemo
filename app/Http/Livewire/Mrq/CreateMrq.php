<?php

namespace App\Http\Livewire\Mrq;

use Carbon\Carbon;
use App\Models\Mrq;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;

class CreateMrq extends Component
{
    use PharmacyStockPoint;

    public $stock_point_to_id = 1, $stock_point_from_id, $code, $request_date, $status, $remarks;
    public $stockPoints = [], $to, $from = [];
    public function mount()
    {
        $this->checkStockPointSession();

        $this->to = \App\Models\StockPoint::first();
        $this->stockPoints = \App\Models\StockPoint::get();
        // dd($this->to);
        $this->from = \App\Models\StockPoint::where('id', '!=', 1)->get(); //except central Pharmacy
        $this->code = $this->getCode(Mrq::max('id'));
        $this->request_date = date('Y-m-d');
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    protected function rules()
    {
        return [

            'stock_point_from_id' => 'required',
            'code' => 'required',
            'request_date' => 'required',

        ];
    }
    public function save()
    {
        // dd($this->stock_point_to_id);
        $validatedData = $this->validate();
        $newMrq = Mrq::create([
            'stock_point_to_id' => $this->stock_point_to_id,
            'stock_point_from_id' => $this->stock_point_from_id,
            'code' => $this->code,
            'request_date' => $this->request_date,
            'status' => false,
            'remarks' => $this->remarks,
        ]);

        //old code
        //     session()->flash('message', 'MRQ Added Successfully.');
        //     $this->reset(['stock_point_from_id','code','request_date']);
        //    $this->dispatchBrowserEvent('close-modal');
        //     $this->code=$this->getCode(Mrq::max('id'));
        //New Code : Redirecting to AddMrqItems
        return redirect()->route('admin.mrq.add-mrq-items', $newMrq->id)->with('message', 'MRQ Added Successfully');
    }
    protected function getCode($maxId)
    {
        $maxId = $maxId + 1;
        if ($maxId < 10)
            return 'MRQ00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'MRQ0' . $maxId;
        else if ($maxId >= 100)
            return 'MRQ' . $maxId;
    }
    public function closeModal()
    {
        $this->reset(['request_date', 'remarks']);
    }
    public function render()
    {
        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->stock_point_from_id = $stockPoint?->id;
        $mrqs = Mrq::where('stock_point_from_id', $stockPoint?->id)->orderBy('id', 'desc')->get();
        return view('livewire.mrq.create-mrq', ['mrqs' => $mrqs, 'stockPoint' => $stockPoint])->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Mrq;

use App\Models\Mrq;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;

class ListStoreMrq extends Component
{
    use PharmacyStockPoint;

    public $stock_point_to_id, $stock_point_from_id, $code, $request_date, $status, $remarks;
    public $stockPoints = [], $to, $from = [];
    public $mrq_id;
    public function mount()
    {
        $this->checkStockPointSession();

        $this->to = StockPoint::first();
        // dd($this->to);
        $this->from = StockPoint::where('id', '!=', 1)->get(); //except central Pharmacy

    }
    public function edit(int $mrq_id)
    {
        // dd($mrq_id);
        $mrq = Mrq::find($mrq_id);
        if ($mrq) {
            $this->mrq_id = $mrq->id;
            $this->stock_point_to_id = $mrq->stock_point_to_id;
            $this->stock_point_from_id = $mrq->stock_point_from_id;
            $this->code = $mrq->code;
            $this->request_date = $mrq->request_date;
            $this->status = $mrq->status;
            $this->remarks = $mrq->remarks;
        } else {
        }
    }

    public function update()
    {
        // $validatedData=$this->validate();
        // Gender::where('id', $this->gender_id)->update([ 'name'=>$validatedData['name'] ]);
        // session()->flash('message', 'Gender Edited Successfully.');
        // $this->reset();
        // $this->dispatchBrowserEvent('close-modal');

    }

    public function render()
    {
        $stockPoint = StockPoint::find(session()->get("stock_point_id"));

        $mrqs = Mrq::when($stockPoint, function ($query) use ($stockPoint) {
            return $query->where('stock_point_to_id', $stockPoint?->id);
        })
            ->orderBy('id', 'desc')
            ->get();

        return view('livewire.mrq.list-store-mrq', ['mrqs' => $mrqs, 'stockPoint' => $stockPoint])->extends('layouts.admin')->section('content');
    }
}

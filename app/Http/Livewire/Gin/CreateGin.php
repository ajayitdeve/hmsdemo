<?php

namespace App\Http\Livewire\Gin;

use App\Models\Gin;
use App\Models\Mrq;
use Livewire\Component;
use App\Models\StockPoint;
use App\Traits\PharmacyStockPoint;
use Illuminate\Support\Facades\Auth;

class CreateGin extends Component
{
    use PharmacyStockPoint;

    public $mrq_id, $code, $status, $remarks, $mrq_info, $stock_point_from, $stock_point_to;
    public $stockPoints = [], $mrqs = [];
    public $stock_point_from_id, $stock_point_to_id, $loginUserStockPoint, $is_internal_transfer = false;
    public $currentGins = [], $ginCount = 0;
    public function mount()
    {
        $this->checkStockPointSession();

        $stockPoint = StockPoint::find(session()->get("stock_point_id"));
        $this->loginUserStockPoint = $stockPoint;

        $this->mrqs = Mrq::when($this->loginUserStockPoint, function ($query) {
            $query->where('stock_point_to_id', $this->loginUserStockPoint?->id);
        })->orderBy('id', 'DESC')->get();

        $this->code = $this->getCode(Gin::max('id'));
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected function rules()
    {
        return [

            'stock_point_to_id' => 'required',
            'stock_point_from_id' => 'required',
            'mrq_id' => 'required',
            'code' => 'required',
        ];
    }

    public function save()
    {
        $this->validate();

        Gin::create([
            //get all mrq where to_ i.e. TO
            //In MRQ if To:Central Pharmacy and From:OP pharmacy.. It will be opposite in GIN/GINITEM/SALESSTORE
            //because  MRQ is Reqest and GIN is Response/Issue
            //SO  TO will be OP Pharmacy and FROM will be central Pharmacy i.e TO: OP Pharmacy and FROM : Central Pharmacy
            'stock_point_id' => $this->stock_point_from_id,
            'stock_point_from_id' => $this->stock_point_to_id,
            'mrq_id' => $this->mrq_id,
            'code' => $this->code,
            'status' => false,
            'remarks' => $this->remarks,
            'created_by_id' => Auth::user()?->id,
        ]);

        session()->flash('message', 'Good Issue Notes Added Successfully.');
        $this->reset(['stock_point_to_id', 'stock_point_from_id', 'mrq_id', 'code', 'status', 'remarks']);
        $this->dispatchBrowserEvent('close-modal');
        $this->code = $this->getCode(Gin::max('id'));
    }

    protected function getCode($maxId)
    {
        $maxId = $maxId + 1;
        if ($maxId < 10)
            return 'GIN00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'GIN0' . $maxId;
        else if ($maxId >= 100)
            return 'GIN' . $maxId;
    }

    public function mrqChanged()
    {
        if ($this->mrq_id > 0) {
            $mrq = Mrq::where('id', $this->mrq_id)->first();
            $this->stock_point_from_id = $mrq->stock_point_from_id;
            $this->stock_point_to_id = $mrq->stock_point_to_id;
            $this->mrq_info = $mrq;

            $this->stock_point_from = $mrq->stockpointfrom->name;
            $this->stock_point_to = $mrq->stockpointto->name;

            //check is there any existing gin for given mrq
            $ginCount = Gin::where('mrq_id', $this->mrq_id)->count();
            $this->ginCount = $ginCount;
            if ($ginCount > 0) {
                $this->currentGins = Gin::where('mrq_id', $this->mrq_id)->get();
            }
        }
    }

    public function render()
    {
        //only central pharmacy .. Internal Transfer seperated
        $gins = Gin::when($this->loginUserStockPoint, function ($query) {
            return $query->where('stock_point_from_id', $this->loginUserStockPoint?->id);
        })->get();

        return view('livewire.gin.create-gin', ['gins' => $gins])->extends('layouts.admin')->section('content');
    }
}

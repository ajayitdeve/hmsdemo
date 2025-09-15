<?php

namespace App\Http\Livewire\Mrq;

use App\Models\Mrq;
use App\Models\MrqItem;
use App\Traits\PharmacyStockPoint;
use Livewire\Component;
use App\Models\RoleStockPoint;
use App\Models\StockPoint;
use Illuminate\Support\Facades\Auth;

class ListMrq extends Component
{
    use PharmacyStockPoint;
    public $mrq_id;

    public function mount()
    {
        $this->checkStockPointSession();
    }

    public function delete(int $mrq_id)
    {
        $this->mrq_id = $mrq_id;
    }

    public function destroy()
    {
        $mrqItems = MrqItem::where('mrq_id', $this->mrq_id)->delete();
        $mrq = Mrq::find($this->mrq_id)->delete();
        session()->flash('message', 'MRQ delete Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $stockPoint = StockPoint::find(session()->get("stock_point_id"));

        $mrqs = Mrq::when($stockPoint, function ($query) use ($stockPoint) {
            return $query->where('stock_point_to_id', $stockPoint->id);
        })->orderBy('id', 'desc')->get();

        return view('livewire.mrq.list-mrq', ['mrqs' => $mrqs])->extends('layouts.admin')->section('content');
    }
}

<?php

namespace App\Http\Livewire\Mrq;

use App\Traits\PharmacyStockPoint;
use Livewire\Component;

class ShowMrq extends Component
{
    use PharmacyStockPoint;

    public $mrq_id, $mrqitem_id, $item_id, $quantity, $approved_quantity;
    public $items = [];
    public function mount($mrq_id)
    {
        $this->checkStockPointSession();

        $this->mrq_id = $mrq_id;
        $this->items = \App\Models\Item::get();
    }
    public function edit(int $mrqitem_id)
    {
        $this->mrqitem_id = $mrqitem_id;
        $mrqItem = \App\Models\MrqItem::find($mrqitem_id);

        if ($mrqItem) {

            $this->item_id = $mrqItem->item_id;
            $this->quantity = $mrqItem->quantity;
            $this->approved_quantity = $mrqItem->approved_quantity;
        } else {
        }
    }
    public function update()
    {
        // $validatedData=$this->validate();
        \App\Models\MrqItem::where('id', $this->mrqitem_id)->update(['approved_quantity' => $this->approved_quantity]);
        session()->flash('message', 'Updated Successfully.');
        $this->reset(['mrqitem_id', 'item_id', 'quantity', 'approved_quantity']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function approveMrq()
    {
        \App\Models\Mrq::find($this->mrq_id)->update(['status' => 1]);
    }
    public function render()
    {
        $mrq = \App\Models\Mrq::find($this->mrq_id);

        return view('livewire.mrq.show-mrq', ['mrq' => $mrq])->extends('layouts.admin')->section('content');
    }
    public function closeModal() {}
}

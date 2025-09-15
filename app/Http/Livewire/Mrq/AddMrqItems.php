<?php

namespace App\Http\Livewire\Mrq;

use App\Traits\PharmacyStockPoint;
use Livewire\Component;

class AddMrqItems extends Component
{
    use PharmacyStockPoint;

    public $mrq_id, $item_id, $quantity;
    public $items = [], $mrqItems = [];
    //varibale for deleting and editing purchase

    public $mrq_item_id;
    public function mount($mrq_id)
    {
        $this->checkStockPointSession();

        $this->mrq_id = $mrq_id;
        $this->items = \App\Models\Item::get();
    }

    public function fetchMrqItems()
    {
        $this->mrqItems = \App\Models\MrqItem::where('mrq_id', $this->mrq_id)->get();
    }
    protected function rules()
    {
        return [
            'item_id' => 'required',
            'quantity' => 'required',
        ];
    }
    public function save()
    {

        $validatedData = $this->validate();

        \App\Models\MrqItem::create([
            'mrq_id' => $this->mrq_id,
            'item_id' => $this->item_id,
            'quantity' => $this->quantity,
            'approved_quantity' => $this->quantity
        ]);

        session()->flash('message', 'MRQ Item Added Successfully.');
        $this->reset('item_id', 'quantity');
        $this->fetchMrqItems();
    }

    public function edit(int $mrq_item_id)
    {
        $this->mrq_item_id = $mrq_item_id;
        $mrqItem = \App\Models\MrqItem::find($mrq_item_id);
        if ($mrqItem) {
            $this->item_id = $mrqItem->item_id;
            $this->quantity = $mrqItem->quantity;
        } else {
            die;
        }
    }
    public function update()
    {
        $mrqItem = \App\Models\MrqItem::find($this->mrq_item_id);
        if ($this->quantity >= $mrqItem->quantity) {
            session()->flash('error', 'Quantity Must Be less than ' . $mrqItem->quantity);
        }
        \App\Models\MrqItem::find($this->mrq_item_id)->update([
            'item_id' => $this->item_id,
            'quantity' => $this->quantity
        ]);

        $this->reset('mrq_item_id', 'item_id', 'quantity');
        session()->flash('message', 'Edited Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function delete(int $mrq_item_id)
    {
        $this->mrq_item_id = $mrq_item_id;
    }

    public function destroy()
    {
        \App\Models\MrqItem::find($this->mrq_item_id)->delete();
        $this->reset('mrq_item_id', 'item_id', 'quantity');
        session()->flash('message', 'Deleted Successfully.');
        $this->dispatchBrowserEvent('close-modal');
    }
    public function render()
    {
        $mrq = \App\Models\Mrq::find($this->mrq_id);
        return view('livewire.mrq.add-mrq-items', ['mrq' => $mrq])->extends('layouts.admin')->section('content');
    }
}

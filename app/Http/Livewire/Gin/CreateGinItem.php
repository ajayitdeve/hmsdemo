<?php

namespace App\Http\Livewire\Gin;

use App\Models\Inventory;
use Livewire\Component;

class CreateGinItem extends Component
{
    public $gin_id, $stock_point_id, $stock_point_from_id, $item_id, $quantity, $mfd, $exd, $batch_no;
    public $gin, $items = [], $batchnumbers = [];
    public $itemstock, $batchStock;
    public $grn_id;
    public $quantityOverflow = false;
    public function mount($gin_id)
    {
        $this->gin_id = $gin_id;
        $this->items = \App\Models\Item::get();
        $this->gin = \App\Models\Gin::find($this->gin_id); //->where('status',1);
        //  dd($this->gin);
        //setting StockPont To and From
        $this->stock_point_id = $this->gin->stock_point_id;
        $this->stock_point_from_id = $this->gin->stock_point_from_id;
    }
    public function itemChanged()
    {
        if ($this->item_id != -1) {
            $item = \App\Models\Item::find($this->item_id);
            $this->batchnumbers = $item->inventories->pluck('batch_no');
            $item = \App\Models\Item::find($this->item_id);
            $this->itemstock = $this->calItemStock();
        }
    }
    public function batchnoChanged()
    {

        if ($this->batch_no != -1) {
            $this->grn_id = $this->getGrnId($this->item_id, $this->batch_no);

            $temp = Inventory::select('exd', 'mfd')->where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->first();
            $this->exd = $temp->exd;
            $this->mfd = $temp->mfd;
            $this->batchStock = $this->calBatchStock();
        }
    }
    protected function rules()
    {
        return [

            'stock_point_id' => 'required',
            'gin_id' => 'required',
            'item_id' => 'required',
            'batch_no' => 'required',
            'mfd' => 'required',
            'exd' => 'required',
            'quantity' => 'required',
        ];
    }
    public function save()
    {
        //  $validatedData=$this->validate();
        //there are two scenatio
        //1-
        //Central Pharmacy -> OP/OT/EMG  | stock_point_from_id (FROM) Central Pharmacy and stock_point_id(TO) OP/OT/EMG
        //In this case  Inventory -> SaleStore

        //2-
        //OP->OT/EMG || OT->OP/EMG || EMG->OP?OT  | stock_point_from_id (FROM) OP/OT/EMP and stock_point_id(TO) OP/OT/EMG   This is Internal Transfer
        //In this case  SalesStore->SalesStore

        //So there is asimple condition to check either internal transfer or not
        //just check stock_point_from_id==1(Central Pharmacy) Then Normal Transfer otherwise Internal Transefer
        //dd($this->stock_point_from_id);
        if ($this->stock_point_from_id == 1) {
            //Normal Transfer
            if ($this->batchStock > $this->quantity) {
                $currentGinItem = \App\Models\GinItem::create([
                    'stock_point_from_id' => $this->stock_point_from_id,
                    'stock_point_id' => $this->stock_point_id,
                    'grn_id' => $this->grn_id,
                    'gin_id' => $this->gin_id,
                    'item_id' => $this->item_id,
                    'batch_no' => $this->batch_no,
                    'mfd' => $this->mfd,
                    'exd' => $this->exd,
                    'quantity' => $this->quantity,
                ]);
                //  dd($currentGinItem->id);
                \App\Models\SaleStore::create([
                    'gin_item_id' => $currentGinItem->id,
                    'stock_point_from_id' => $this->stock_point_from_id,
                    'stock_point_id' => $this->stock_point_id,
                    'gin_id' => $this->gin_id,
                    'item_id' => $this->item_id,
                    'batch_no' => $this->batch_no,
                    'mfd' => $this->mfd,
                    'exd' => $this->exd,
                    'quantity' => $this->quantity,
                ]);
                session()->flash('message', 'GIN Added Successfully.');
                // $this->reset('stock_point_id', 'item_id', 'batch_no', 'mfd', 'exd', 'quantity');
                $this->fetchGin();
            } else {
                session()->flash('error', 'Invalid Quantity.');
            }
        } else {
            //Internal Transfer
            //creating new component PharmacyInternalTransfer
            // if($this->batchStock > $this->quantity)   {
            //     $currentGinItem= \App\Models\GinItem::create([
            //         'stock_point_from_id' => $this->stock_point_from_id,
            //         'stock_point_id' => $this->stock_point_id,
            //          'grn_id'=>$this->grn_id,
            //          'gin_id'=>$this->gin_id,
            //          'item_id'=>$this->item_id,
            //          'batch_no'=>$this->batch_no,
            //          'mfd'=>$this->mfd,
            //          'exd'=>$this->exd,
            //          'quantity'=>$this->quantity,
            //      ]);
            //      //for internal transfer
            //    //  dd($currentGinItem->id);
            //      \App\Models\SaleStore::create([
            //          'gin_item_id'=>$currentGinItem->id,
            //          'stock_point_id'=>$this->gin->stock_point_id,
            //          'gin_id'=>$this->gin_id,
            //          'item_id'=>$this->item_id,
            //          'batch_no'=>$this->batch_no,
            //          'mfd'=>$this->mfd,
            //          'exd'=>$this->exd,
            //          'quantity'=>$this->quantity,

            //      ]);
            //      session()->flash('message', 'GIN Added Successfully.');
            //      $this->reset('stock_point_id', 'item_id', 'batch_no', 'mfd', 'exd', 'quantity');
            //   $this->fetchGin();
            //  }else{
            //      session()->flash('error', 'Invalid Quantity.');
            //  }
        }
    }
    public function fetchGin()
    {

        $this->items = \App\Models\Item::get();
        $this->gin = \App\Models\Gin::find($this->gin_id);
    }
    public function calItemStock()
    {
        $inventorySum = Inventory::where('item_id', $this->item_id)->sum('quantity');
        $inventoryBonusSum = Inventory::where('item_id', $this->item_id)->sum('bonus');
        $ginSum = \App\Models\GinItem::where('item_id', $this->item_id)->sum('quantity');
        return $inventorySum + $inventoryBonusSum - $ginSum;
    }

    public function calBatchStock()
    {
        $item = \App\Models\Item::find($this->item_id);
        $batchStockInventorySum = Inventory::where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('quantity');
        $batchStockInventoryBonusSum = Inventory::where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->sum('bonus');
        $batchStockGinItemSum = \App\Models\GinItem::where('item_id', $item->id)->where('batch_no', $this->batch_no)->sum('quantity');
        return $batchStockInventorySum + $batchStockInventoryBonusSum - $batchStockGinItemSum;
    }

    public function quantityChanged()
    {
        $this->batchStock <= $this->quantity ? $this->quantityOverflow = true : $this->quantityOverflow = false;
    }

    public function getGrnId($itemId, $batchNo)
    {
        $grn = Inventory::where('item_id', $itemId)->where('batch_no', $batchNo)->first()->grn;
        return $grn->id;
    }
    public function render()
    {

        return view('livewire.gin.create-gin-item')->extends('layouts.admin')->section('content');;
    }
}

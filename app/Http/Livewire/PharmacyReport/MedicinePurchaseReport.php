<?php

namespace App\Http\Livewire\PharmacyReport;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Vendor;
use Livewire\Component;
use App\Models\Inventory;
use App\Exports\InventoryExport;
use Maatwebsite\Excel\Facades\Excel;

class MedicinePurchaseReport extends Component
{
    public $from, $to, $vendor_id=0, $item_id=0, $batch_no=null;
    public $items = [], $vendors = [], $batches = [], $inventories = [];
    public function mount()
    {
        // $this->from = date("Y-m-d");
        // $this->to = date("Y-m-d");
        $this->items = Item::where('type_id', 1)->get();
        $this->vendors = Vendor::get();
        $this->batches = Inventory::select('batch_no')->distinct()->get();

    }
    public function search()
    {
        $from = $this->from!=null?date('Y-m-d', strtotime($this->from)):null;
        $to = $this->to!=null?date('Y-m-d', strtotime($this->to)):null;
        if ($this->vendor_id == 0 && $this->item_id == 0 && $this->batch_no == null) {
            $this->inventories = Inventory::whereBetween('created_at', [$from, $to])->get();
        }
        if ($this->vendor_id == 0 && $this->item_id == 0 && $this->batch_no != 0) {

            $this->inventories = Inventory::whereBetween('created_at', [$from, $to])->where('batch_no', $this->batch_no)->get();
        }
        if ($this->vendor_id == 0 && $this->item_id != 0 && $this->batch_no == 0) {
            $this->inventories = Inventory::whereBetween('created_at', [$from, $to])->where('item_id', $this->item_id)->get();
        }
        if ($this->vendor_id == 0 && $this->item_id != 0 && $this->batch_no != 0) {
            $this->inventories = Inventory::whereBetween('created_at', [$from, $to])->where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->get();
        }
        if ($this->vendor_id != 0 && $this->item_id == 0 && $this->batch_no != 0) {

            $inventories = Inventory::whereBetween('created_at', [$from, $to])->where('batch_no', $this->batch_no)->get();
            $this->inventories = $inventories->filter(function ($item) {
                return $item->grn->vendor->id == $this->vendor_id;
            });

        }
        //the following code is working fine
        if ($this->vendor_id != 0 && $this->item_id == 0 && $this->batch_no== null) {
            if($this->from!=null && $this->to!=null) {

                $inventories = Inventory::whereBetween('created_at', [$from, $to])->get();
                $this->inventories = $inventories->filter(function ($item) {
                    return $item->grn->vendor->id == $this->vendor_id;
                });
            }else{
                $inventories = Inventory::get();
                $this->inventories = $inventories->filter(function ($item) {
                    return $item->grn->vendor->id == $this->vendor_id;
                });
            }


        }
        if ($this->vendor_id != 0 && $this->item_id != 0 && $this->batch_no == null) {
           // dd($this->from);
            if($this->from!=null && $this->to!=null) {

                $inventories = Inventory::whereBetween('created_at', [$from, $to])->where('item_id',$this->item_id)->get();
                $this->inventories = $inventories->filter(function ($item) {
                    return $item->grn->vendor->id == $this->vendor_id;
                });
            }else{

                $inventories = Inventory::get();
                $this->inventories = $inventories->filter(function ($item) {
                    return $item->grn->vendor->id == $this->vendor_id && $item->item_id==$this->item_id;
                });
            }





            $inventories = Inventory::whereBetween('created_at', [$from, $to])->where('item_id', $this->item_id)->get();
            $this->inventories = $inventories->filter(function ($item) {
                return $item->grn->vendor->id == $this->vendor_id;
            });
        }
        if ($this->vendor_id != 0 && $this->item_id != 0 && $this->batch_no != 0) {
            $inventories = Inventory::whereBetween('created_at', [$from, $to])->where('item_id', $this->item_id)->where('batch_no', $this->batch_no)->get();
            $this->inventories = $inventories->filter(function ($item) {
                return $item->grn->vendor->id == $this->vendor_id;
            });
        }
        //  dd($this->inventories);
    }
    public function exportExcel(){
        return Excel::download(new InventoryExport($this->inventories), 'report.xlsx');
    }
    public function render()
    {
        return view('livewire.pharmacy-report.medicine-purchase-report')->extends('layouts.admin')->section('content');
    }
}

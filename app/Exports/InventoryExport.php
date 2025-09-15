<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InventoryExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $data;
    public function __construct($data){
        $this->data = $data;
    }
    public function headings(): array{
        return ['ID','Item','Vendor','Batch No','Quantity','Purchase Rate','MRP','Expiry Date','Date'];
    }
    public function map($inventory): array{
        return [
            $inventory->id,
            $inventory->item->description,
            $inventory->grn->vendor->name,
            $inventory->batch_no,
            $inventory->quantity,
            $inventory->purchase_rate,
            $inventory->mrp,
            $inventory->exd,
            $inventory->created_at];
    }
    public function collection()
    {
        //return Inventory::all();
        return $this->data;
    }
}

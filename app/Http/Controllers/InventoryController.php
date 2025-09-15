<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\GinItem;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories=Inventory::orderBy("created_at","desc")->get();
        return view("admin.inventory.index",["inventories"=>$inventories]);
    }


    public function stock(){
        $data=[];
     $inventories=Inventory::get();

     foreach( $inventories as $inventory ){
        $ginCount=GinItem::where('item_id',$inventory->item_id)->count();
        $balnceItemStock=0;
        $bonus=Inventory::where('item_id',$inventory->item_id)->sum('bonus');
        if($ginCount>0){
            $itemCountInInventory=Inventory::where('item_id',$inventory->item_id)->sum('quantity');
            $itemCountInGinItem=GinItem::where('item_id',$inventory->item_id)->sum('quantity');
            $balnceItemStock= ($itemCountInInventory -  $itemCountInGinItem);
        }else{
         $balnceItemStock=Inventory::where('item_id',$inventory->item_id)->sum('quantity');
        }

        //`id`, `grn_id`, `item_id`, `batch_no`, `mfd`, `exd`, `quantity`, `purchase_rate`, `bonus`, `mrp`, `discount`, `tax`, `hsncode`, `deleted_at`, `created_at`, `updated_at`
        $temp=[];
        $temp['id']=$inventory->id;
        $temp['item']=$inventory->item->description;
        $temp['description']=$inventory->item->description;
        $temp['generic']=$inventory->item->generic->name;
        $temp['code']=$inventory->item->code;
        $temp['batch_no']=$inventory->batch_no;
        $temp['mfd']=$inventory->mfd;
        $temp['exd']=$inventory->exd;
        $temp['quantity']= $balnceItemStock + $bonus;
        array_push($data,$temp);
    }
   // dd($data);
   return view("admin.inventory.stock",["inventories"=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        //
    }

    public function purchase_report(){
        return view("pharmacy.purchase-report");

    }
}

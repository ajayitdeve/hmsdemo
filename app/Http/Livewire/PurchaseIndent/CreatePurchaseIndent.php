<?php

namespace App\Http\Livewire\PurchaseIndent;

use Livewire\Component;
use App\Models\PurchaseIndent;
use Livewire\WithPagination;

class CreatePurchaseIndent extends Component
{
    use WithPagination;
    public $stock_point_id,$vendor_id,$type_id,$code,$date,$request_date,$status,$remarks;
    public $stockpoints=[],$vendors=[],$types=[];
public function mount(){
   $this->stockpoints = \App\Models\StockPoint::all();
   $this->vendors = \App\Models\Vendor::all();
   $this->types = \App\Models\Type::all();  
}
protected function rules()
    {
        return [
            'stock_point_id'=>'required',
            'vendor_id'=>'required',
            'type_id'=>'required',
            'code'=>'required',
            'date'=>'required',
            'request_date'=>'required',
            'status'=>'required',
            'remarks'=>'required',
          ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }
    public function save(){
      $validatedData=$this->validate();
     $purchaseIndent=PurchaseIndent::create($validatedData);

        session()->flash('message','Purchase Indent  Added Successfully.');
        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }
public function edit(int $item_group_id){
    // $itemgroup=ItemGroup::find($item_group_id);
    // if($itemgroup){
    //     $this->name=$itemgroup->name;
    //     $this->type_id=$itemgroup->type_id;
    //     $this->cost_center_id=$itemgroup->cost_center_id;
    // }else{

    // }

}

public function update(){
  
    // $validatedData=$this->validate();
    // ItemGroup::where('id',$this->stock_point_id)->update([ 'name'=>$validatedData['name'] ]);
    // session()->flash('message','Item Group Edited Successfully.');
    // $this->resetInput();
    // $this->dispatchBrowserEvent('close-modal');
}


public function delete(int $stock_point_id){
    // $this->stock_point_id=$stock_point_id;
}

public function destroy(){
    // $stockpoint=ItemGroup::find($this->item_group_id_id)->delete();
    // session()->flash('message',
    // 'Stockpont  delete Successfully.');
    // $this->resetInput();
    // $this->dispatchBrowserEvent('close-modal');
}
public function closeModal(){
    $this->resetInput();
}
    public function resetInput(){
        $this->name='';
    }
   

    public function render()
    {
        $purchaseIndents=PurchaseIndent::get();
        return view('livewire.purchase-indent.create-purchase-indent',['purchaseIndents'=>$purchaseIndents])->extends('layouts.admin')->section('content');
    }
}

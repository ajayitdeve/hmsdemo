<?php
namespace App\Services;
class ScrapTransferCart{
    //'scrap_id','item_id','grn_id','scrap_type_id','batch_no','quantity','unit_sale_price','unit_purchase_price','remarks','created_by_id','updated_by_id'
    public $id,$item_id,$item_code,$item_description,$grn_id,$scrap_type_id,$batch_no,$quantity,$unit_sale_price,$unit_purchase_price,$remarks,$created_by_id,$updated_by_id;


    function __construct($id,$item_id,$item_code,$item_description,$grn_id,$scrap_type_id,$batch_no,$quantity,$unit_sale_price,$unit_purchase_price,$remarks,$created_by_id,$updated_by_id) {
      $this->id=$id;
      $this->item_id=$item_id;
      $this->item_code=$item_code;
      $this->item_desctiption=$item_description;
      $this->grn_id=$grn_id;
      $this->scrap_type_id=$scrap_type_id;
      $this->batch_no=$batch_no;
      $this->quantity=$quantity;
      $this->unit_sale_price=$unit_sale_price;
      $this->unit_purchase_price=$unit_purchase_price;
      $this->remarks=$remarks;
      $this->created_by_id=$created_by_id;
      $this->updated_by_id=$updated_by_id;
    }
}

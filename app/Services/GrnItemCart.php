<?php
namespace App\Services;
class GrnItemCart{
public $id,$grn_id,$grn_code,$item_id,$item_code,$item_description,$batch_no,$mfd,$exd,$quantity,$purchase_rate,$bonus,$mrp,$discount,$tax,$hsncode;
    function __construct($id,$grn_id,$grn_code,$item_id,$item_code,$item_description,$batch_no,$mfd,$exd,$quantity,$purchase_rate,$bonus,$mrp,$discount,$tax,$hsncode) {
        $this->id=$id;
        $this->grn_id=$grn_id;
        $this->grn_code=$grn_code;
        $this->item_id=$item_id;
        $this->item_code=$item_code;
        $this->item_description=$item_description;
        $this->batch_no=$batch_no;
        $this->mfd=$mfd;
        $this->exd=$exd;
        $this->quantity=$quantity;
        $this->purchase_rate=$purchase_rate;
        $this->bonus=$bonus;
        $this->mrp=$mrp;
        $this->discount=$discount;
        $this->tax=$tax;
        $this->hsncode=$hsncode;

      }
}

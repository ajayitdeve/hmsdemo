<?php
namespace App\MrqItemCart;
class MrqItemCart{
public $id,$item_id,$batch_no,$mfd,$exd,$quantity,$purchase_rate,$bonus,$mrp,$discount,$tax,$hsncode;
    function __construct($id,$item_id,$batch_no,$mfd,$exd,$quantity,$purchase_rate,$bonus,$mrp,$discount,$tax,$hsncode) {
        $this->id=$id;
        $this->item_id=$item_id;
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

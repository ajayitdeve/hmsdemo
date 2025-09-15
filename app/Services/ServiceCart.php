<?php

namespace App\Services;

class ServiceCart
{
  // public $id,$service_id,$quantity,$rate;
  public $id, $service_id, $service_code, $service_name, $quantity, $unit_service_price, $amount, $discount, $total, $discount_approved_by_id;


  function __construct($id, $service_id, $service_code, $service_name, $quantity, $unit_service_price, $amount, $discount, $total, $discount_approved_by_id)
  {
    $this->id = $id;
    $this->service_id = $service_id;
    $this->service_code = $service_code;
    $this->service_name = $service_name;
    $this->quantity = $quantity;
    $this->unit_service_price = $unit_service_price;
    $this->amount = $amount;
    $this->discount = $discount;
    $this->total = $total;
    $this->discount_approved_by_id = $discount_approved_by_id;
  }
}

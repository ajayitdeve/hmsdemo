<?php
namespace App\Services;
class ServiceCartOverallDiscount{
   public $id,$service_id,$service_code,$service_name,$quantity,$unit_service_price,$amount,$total;


    function __construct($id,$service_id,$service_code,$service_name,$quantity,$unit_service_price,$amount,$total) {
      $this->id=$id;
      $this->service_id=$service_id;
      $this->service_code=$service_code;
      $this->service_name=$service_name;
      $this->quantity=$quantity;
      $this->unit_service_price=$unit_service_price;
      $this->amount=$amount;
      $this->total=$total;

      }
}

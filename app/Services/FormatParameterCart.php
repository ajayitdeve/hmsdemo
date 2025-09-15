<?php
namespace App\Services;
class FormatParameterCart{

public $id,$parameter_id,$sub_title;
    function __construct($id,$parameter_id,$sub_title) {
        $this->id=$id;
        $this->parameter_id=$parameter_id;
        $this->sub_title=$sub_title;
        }
}

<?php
namespace App\Services;
class ParameterCart{

public $id,$parameter_id,$parameter_unit_id,$symbol_id,$gender,$min_age,$min_age_uom,$max_age,$max_age_uom,$min_range,$max_range,$normal_range,$min_critical,$max_critical,$description;
    function __construct($id,$parameter_unit_id,$symbol_id,$gender,$min_age,$min_age_uom,$max_age,$max_age_uom,$min_range,$max_range,$normal_range_value,$min_critical,$max_critical,$description) {
        $this->id=$id;
        $this->parameter_unit_id=$parameter_unit_id;
        $this->symbol_id=$symbol_id;
        $this->gender=$gender;
        $this->min_age=$min_age;
        $this->min_age_uom=$min_age_uom;
        $this->max_age=$max_age;
        $this->max_age_uom=$max_age_uom;
        $this->min_range=$min_range;
        $this->max_range=$max_range;
        $this->normal_range_value=$normal_range_value;
        $this->min_critical=$min_critical;
        $this->max_critical=$max_critical;
        $this->description=$description;
      }
}

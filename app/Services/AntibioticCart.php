<?php
namespace App\Services;
class AntibioticCart{

public $id,$antibiotic_id,$code,$name,$senstive,$moderate,$resistance,$is_active;
    function __construct($id,$antibiotic_id,$code,$name,$senstive,$moderate,$resistance,$is_active) {
        $this->id=$id;
        $this->antibiotic_id=$antibiotic_id;
        $this->code=$code;
        $this->name=$name;
        $this->senstive=$senstive;
        $this->moderate=$moderate;
        $this->resistance=$resistance;
        $this->is_active=$is_active;
        }
}

<?php

namespace App\Traits;

use App\Models\Doctor;
use App\Models\User;

trait OtAttendantCreate
{
    public function mountOtAttendantCreate()
    {
        $this->attendant_types = [
            ['id' => 1, 'name' => 'User'],
            ['id' => 2, 'name' => 'Doctor'],
        ];

        $this->arrCart[] = array(
            "attendant_name" => "",
            "attendant_type" => "",
            "attendant_type_id" => "",

            "attendant_list" => [],
            "attendant_id" => "",
            "attendant_code" => "",
        );
    }

    public function attendantTypeChanged($index)
    {
        if ($this->arrCart[$index]['attendant_type_id'] == 1) {
            $this->arrCart[$index]["attendant_name"] = "User";
            $this->arrCart[$index]["attendant_type"] = "\App\Models\User";

            $this->arrCart[$index]["attendant_list"] = User::all();
        }
        if ($this->arrCart[$index]['attendant_type_id'] == 2) {
            $this->arrCart[$index]["attendant_name"] = "Doctor";
            $this->arrCart[$index]["attendant_type"] = "\App\Models\Doctor";

            $this->arrCart[$index]["attendant_list"] = Doctor::all();
        }
    }

    public function attendantChanged($index)
    {
        $attendant = $this->arrCart[$index]["attendant_type"]::find($this->arrCart[$index]["attendant_id"]);
        if ($attendant) {
            $this->arrCart[$index]["attendant_code"] = $attendant?->code;
        }
    }

    public function addRow()
    {
        $this->arrCart[] = array(
            "attendant_name" => "",
            "attendant_type" => "",
            "attendant_type_id" => "",

            "attendant_list" => [],
            "attendant_id" => "",
            "attendant_code" => "",
        );
    }

    public function removeRow($index)
    {
        if (count($this->arrCart) == 1) {
            session()->flash('error', 'At least one row is required.');
            return;
        }

        unset($this->arrCart[$index]);
    }
}

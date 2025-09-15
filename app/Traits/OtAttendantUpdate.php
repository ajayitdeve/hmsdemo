<?php

namespace App\Traits;

use App\Models\Doctor;
use App\Models\User;

trait OtAttendantUpdate
{
    public function mountOtAttendantUpdate()
    {
        $this->attendant_types = [
            ['id' => 1, 'name' => 'User'],
            ['id' => 2, 'name' => 'Doctor'],
        ];
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

    public function ot_booking_attendant_init($ot_booking)
    {
        if ($ot_booking->attendants()->count() > 0) {
            $this->arrCart = [];
            foreach ($ot_booking->attendants as $attendant) {
                $attendant_type_id = $attendant->attendant_type === '\App\Models\User' ? 1 : 2;
                $attendant_list = $attendant_type_id === 1 ? User::all() : Doctor::all();

                $this->arrCart[] = [
                    "attendant_name" => $attendant->name,
                    "attendant_type" => $attendant->attendant_type,
                    "attendant_type_id" => $attendant_type_id,
                    "attendant_list" => $attendant_list,
                    "attendant_id" => $attendant->attendant_id,
                    "attendant_code" => $attendant->attendant_type::find($attendant->attendant_id)?->code,
                ];
            }
        } else {
            $this->addRow();
        }
    }

    public function ot_day_care_attendant_init($ot_day_care)
    {
        if ($ot_day_care->attendants()->count() > 0) {
            $this->arrCart = [];
            foreach ($ot_day_care->attendants as $attendant) {
                $attendant_type_id = $attendant->attendant_type === '\App\Models\User' ? 1 : 2;
                $attendant_list = $attendant_type_id === 1 ? User::all() : Doctor::all();

                $this->arrCart[] = [
                    "attendant_name" => $attendant->name,
                    "attendant_type" => $attendant->attendant_type,
                    "attendant_type_id" => $attendant_type_id,
                    "attendant_list" => $attendant_list,
                    "attendant_id" => $attendant->attendant_id,
                    "attendant_code" => $attendant->attendant_type::find($attendant->attendant_id)?->code,
                ];
            }
        } else {
            $this->addRow();
        }
    }

    public function ot_pre_operation_attendant_init($pre_operartion)
    {
        if ($pre_operartion->attendants()->count() > 0) {
            $this->arrCart = [];
            foreach ($pre_operartion->attendants as $attendant) {
                $attendant_type_id = $attendant->attendant_type === '\App\Models\User' ? 1 : 2;
                $attendant_list = $attendant_type_id === 1 ? User::all() : Doctor::all();

                $this->arrCart[] = [
                    "attendant_name" => $attendant->name,
                    "attendant_type" => $attendant->attendant_type,
                    "attendant_type_id" => $attendant_type_id,
                    "attendant_list" => $attendant_list,
                    "attendant_id" => $attendant->attendant_id,
                    "attendant_code" => $attendant->attendant_type::find($attendant->attendant_id)?->code,
                ];
            }
        } else {
            $this->addRow();
        }
    }

    public function ot_post_operation_attendant_init($post_operartion)
    {
        if ($post_operartion->attendants()->count() > 0) {
            $this->arrCart = [];
            foreach ($post_operartion->attendants as $attendant) {
                $attendant_type_id = $attendant->attendant_type === '\App\Models\User' ? 1 : 2;
                $attendant_list = $attendant_type_id === 1 ? User::all() : Doctor::all();

                $this->arrCart[] = [
                    "attendant_name" => $attendant->name,
                    "attendant_type" => $attendant->attendant_type,
                    "attendant_type_id" => $attendant_type_id,
                    "attendant_list" => $attendant_list,
                    "attendant_id" => $attendant->attendant_id,
                    "attendant_code" => $attendant->attendant_type::find($attendant->attendant_id)?->code,
                ];
            }
        } else {
            $this->addRow();
        }
    }
}

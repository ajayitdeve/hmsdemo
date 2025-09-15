<?php

namespace App\Traits;

trait NurseDepartment
{
    public function checkNurseStationSession()
    {
        if (!session()->has("nurse_station_id")) {
            return redirect()->route("admin.nurse.nurse-station")->with("error", "Please select a department first");
        }
    }
}

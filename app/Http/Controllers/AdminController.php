<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $expired_medicine_list = Inventory::with('item')
            ->whereHas('item', function ($q) {
                $q->whereNotNull('alert_days_before_expiry');
            })
            ->whereRaw("DATE_SUB(exd, INTERVAL (SELECT alert_days_before_expiry FROM items WHERE items.id = inventories.item_id) DAY) < CURDATE()")
            ->get();

        return view('index', compact('expired_medicine_list'));
    }

    public function pharmacy_dashboard()
    {

        return view('pharmacy-dashboard');
    }

    //dashboard to switch for admin
    // public function admin_dashboard(){
    //     return view('admin-dashboard');
    // }

    // public function superadmin_dashboard(){
    //     return view('superadmin-dashboard');
    // }
    // public function pharmacy_dashboard(){
    //     return view('pharmacy-dashboard');
    // }

    // public function op_pharmacy_dashboard(){
    //     return view('op-pharmacy-dashboard');
    // }
    // public function ot_pharmacy_dashboard(){
    //     return view('ot-pharmacy-dashboard');
    // }
    // public function emg_pharmacy_dashboard(){
    //     return view('emg-pharmacy-dashboard');
    // }

    // public function opd_co_dashboard(){
    //     return view('opd-co-dashboard');
    // }

}

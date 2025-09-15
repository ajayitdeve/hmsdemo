<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = array(
            array('id' => '1', 'code' => 'MAN1', 'name' => 'Aplexia Pharma Pvt Ltd', 'legal_name' => 'Aplexia Pharma Pvt Ltd', 'address' => NULL, 'phone' => NULL, 'cst_no' => '12345', 'drug_license_no' => '12345', 'drug_license_exp_date' => '2028-02-26', 'gst_no' => '1234567890', 'pan_no' => 'CDXPP066M', 'payment_days' => '10', 'delivery_days' => '10', 'type_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '2', 'code' => 'MAN2', 'name' => '3M Private Limites', 'legal_name' => '3M Private Limites', 'address' => NULL, 'phone' => NULL, 'cst_no' => '123456', 'drug_license_no' => '1234567', 'drug_license_exp_date' => '2025-02-26', 'gst_no' => '1234567890', 'pan_no' => 'CDXXPPO667C', 'payment_days' => '10', 'delivery_days' => '10', 'type_id' => '1', 'created_at' => now(), 'updated_at' => now())
        );

        Vendor::insert($vendors);
    }
}

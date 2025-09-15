<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StockPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stock_points = array(
            array('name' => 'Central Pharmcy', 'code' => 'CP', 'type_id' => '1', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'OP Pharmacy', 'code' => 'OPH', 'type_id' => '1', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'OT Pharmacy', 'code' => 'OT Ph', 'type_id' => '1', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Emergency Pharmacy', 'code' => 'OT Ph', 'type_id' => '1', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now())
        );

        \App\Models\StockPoint::insert($stock_points);
    }
}

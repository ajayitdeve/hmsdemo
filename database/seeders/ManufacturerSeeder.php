<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManufacturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Manufacturer::insert([
            ['name' => '3M India Limited', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aplexia Pharma Pvt. Ltd.', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

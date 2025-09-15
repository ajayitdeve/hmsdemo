<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ItemSpecialization::insert([
            ['name' => 'General Medicine', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Anatomy', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accounts', 'type_id' => 2, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

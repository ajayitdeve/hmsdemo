<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::insert([
            ['name' => 'General', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ABSORBABLE HAEMOSTAT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ACE + ARB', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

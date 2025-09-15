<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Specialization::insert([
            ['name' => 'Urology', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Orthopedics', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'General Surgery', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Neurosurgery', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = array(
            array('name' => 'Orthopaedic Unit -1', 'department_id' => '1', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Orthopaedic Unit -2', 'department_id' => '1', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Pediatric Unit -1', 'department_id' => '2', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Pediatric Unit -2', 'department_id' => '2', 'created_by_id' => '1', 'updated_by_id' => NULL, 'created_at' => now(), 'updated_at' => now())
        );
        \App\Models\Unit::insert($units);
    }
}

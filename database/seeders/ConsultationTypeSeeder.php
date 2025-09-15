<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConsultationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $consultation_types = array(
            array('name' => 'OP', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'IP', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Both', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Not Required', 'created_at' => now(), 'updated_at' => now())
        );

        \App\Models\ConsultationType::insert($consultation_types);
    }
}

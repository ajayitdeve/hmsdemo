<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = array(
            array('name' => 'Medical', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'Non Medical', 'cost_center_id' => '1', 'created_at' => now(), 'updated_at' => now())
        );
        \App\Models\Type::insert($types);
    }
}

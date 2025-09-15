<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uoms = array(
            array('name' => 'PICES', 'code' => 'PCS', 'created_at' => now(), 'updated_at' => now()),
            array('name' => 'NUMBER', 'code' => 'NUMBER', 'created_at' => now(), 'updated_at' => now())
        );

        \App\Models\Uom::insert($uoms);
    }
}

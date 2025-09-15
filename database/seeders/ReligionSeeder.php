<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = array(
            array('id' => '1', 'name' => 'Hindu', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '2', 'name' => 'Muslim', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '3', 'name' => 'Sikh', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '4', 'name' => 'Christian', 'created_at' => now(), 'updated_at' => now())
        );
        Religion::insert($religions);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Marital;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaritalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Marital::insert([
            ['name' => 'Single'],
            ['name' => 'Married']
        ]);
    }
}

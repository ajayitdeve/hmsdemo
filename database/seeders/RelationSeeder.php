<?php

namespace Database\Seeders;

use App\Models\Relation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Relation::insert([
            ['name' => 'S/O', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'D/O', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'W/O', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleStockPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleStockPoints = [
            ['name' => 'OP Pharmacy', 'role_id' => 1, 'stock_point_id' => 2, 'created_by_id' => 1],
            ['name' => 'Central Pharmacy', 'role_id' => 2, 'stock_point_id' => 1, 'created_by_id' => 1],
            ['name' => 'OT Pharmacy', 'role_id' => 4, 'stock_point_id' => 3, 'created_by_id' => 1],
            ['name' => 'Emergency Pharmacy', 'role_id' => 5, 'stock_point_id' => 4, 'created_by_id' => 1],
        ];
        \App\Models\RoleStockPoint::insert($roleStockPoints);
    }
}

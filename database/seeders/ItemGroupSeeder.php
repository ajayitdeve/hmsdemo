<?php

namespace Database\Seeders;

use App\Models\ItemGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item_groups = array(
            array('id' => '1', 'name' => 'MEDICAL', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 10:59:40', 'updated_at' => '2023-09-23 10:59:40'),
            array('id' => '2', 'name' => 'BIOMEDICAL', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:00:25', 'updated_at' => '2023-09-23 11:00:25'),
            array('id' => '3', 'name' => 'EYE LENSE', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:00:57', 'updated_at' => '2023-09-23 11:00:57'),
            array('id' => '4', 'name' => 'IMPLANTS', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:01:21', 'updated_at' => '2023-09-23 11:01:21'),
            array('id' => '5', 'name' => 'LABORATORY ITEMS', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:01:36', 'updated_at' => '2023-09-23 11:01:36'),
            array('id' => '6', 'name' => 'MEDICAL EQUIPMENT', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:01:51', 'updated_at' => '2023-09-23 11:01:51'),
            array('id' => '7', 'name' => 'SURGICAL', 'cost_center_id' => '1', 'type_id' => '1', 'created_at' => '2023-09-23 11:02:20', 'updated_at' => '2023-09-23 11:02:20')
        );

        ItemGroup::insert($item_groups);
    }
}

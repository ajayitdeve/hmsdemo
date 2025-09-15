<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = array(
            array('id' => '1', 'description' => 'Ocid 20', 'code' => 'OCICO1', 'hsn' => '1234', 'igst' => '12', 'cgst' => '6', 'sgst' => '6', 'type_id' => '1', 'item_group_id' => '1', 'generic_id' => '21', 'form_id' => '13', 'category_id' => '1', 'item_specialization_id' => '1', 'manufacturer_id' => '1', 'purchase_uom_id' => '1', 'issue_uom_id' => '1', 'created_at' => now(), 'updated_at' => now()),
            array('id' => '2', 'description' => 'Calpol', 'code' => 'CALCO2', 'hsn' => '1234', 'igst' => '12', 'cgst' => '6', 'sgst' => '6', 'type_id' => '1', 'item_group_id' => '1', 'generic_id' => '21', 'form_id' => '13', 'category_id' => '1', 'item_specialization_id' => '1', 'manufacturer_id' => '1', 'purchase_uom_id' => '1', 'issue_uom_id' => '1', 'created_at' => now(), 'updated_at' => now())
        );
        Item::insert($items);
    }
}

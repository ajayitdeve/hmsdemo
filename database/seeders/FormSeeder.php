<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = array(
            0 => array('name' => 'ACS', 'code' => 'ACS', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            1 => array('name' => 'BOT', 'code' => 'BOT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            2 => array('name' => 'CAP', 'code' => 'CAP', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            3 => array('name' => 'CRE', 'code' => 'CRE', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            4 => array('name' => 'DEN', 'code' => 'DEN', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            5 => array('name' => 'DRO', 'code' => 'DRO', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            6 => array('name' => 'EQI', 'code' => 'EQI', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            7 => array('name' => 'FLU', 'code' => 'FLU', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            8 => array('name' => 'GEL', 'code' => 'GEL', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            9 => array('name' => 'GEN', 'code' => 'GEN', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            10 => array('name' => 'INH', 'code' => 'INH', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            11 => array('name' => 'INJ', 'code' => 'INJ', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            12 => array('name' => 'TAB', 'code' => 'TAB', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            13 => array('name' => 'IVF', 'code' => 'IVF', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            14 => array('name' => 'JAR', 'code' => 'JAR', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            15 => array('name' => 'KIT', 'code' => 'KIT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            16 => array('name' => 'LOT', 'code' => 'LOT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            17 => array('name' => 'OIL', 'code' => 'OIL', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            18 => array('name' => 'OIN', 'code' => 'OIN', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            19 => array('name' => 'OPH', 'code' => 'OPH', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            20 => array('name' => 'PAD', 'code' => 'PAD', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            21 => array('name' => 'PAR', 'code' => 'PAR', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            22 => array('name' => 'PAT', 'code' => 'PAT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            23 => array('name' => 'PC', 'code' => 'PC', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            24 => array('name' => 'PKT', 'code' => 'PKT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            25 => array('name' => 'POW', 'code' => 'POW', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            26 => array('name' => 'RES', 'code' => 'RES', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            27 => array('name' => 'ROT', 'code' => 'ROT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            28 => array('name' => 'SAC', 'code' => 'SAC', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            29 => array('name' => 'SET', 'code' => 'SET', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            30 => array('name' => 'SHA', 'code' => 'SHA', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            31 => array('name' => 'SOL', 'code' => 'SOL', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            32 => array('name' => 'SOP', 'code' => 'SOP', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            33 => array('name' => 'SPR', 'code' => 'SPR', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            34 => array('name' => 'SUR', 'code' => 'SUR', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            35 => array('name' => 'SUT', 'code' => 'SUT', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            36 => array('name' => 'SYR', 'code' => 'SYR', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
            37 => array('name' => 'VAC', 'code' => 'VAC', 'type_id' => 1, 'cost_center_id' => 1, 'created_at' => now(), 'updated_at' => now()),
        );

        \App\Models\Form::insert($forms);
    }
}

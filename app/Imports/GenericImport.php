<?php

namespace App\Imports;

use App\Models\Generic;
use Maatwebsite\Excel\Concerns\ToModel;

class GenericImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (empty($row[0])) {
            return null;
        }

        $generic = Generic::where('name', $row[0])->first();
        if ($generic) {
            return null;
        }

        return new Generic([
            'name' => $row[0],
            'type_id' => 1,
            'cost_center_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

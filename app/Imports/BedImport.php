<?php

namespace App\Imports;

use Auth;
use App\Models\Ipd\Bed;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithSkipDuplicates;

class BedImport implements ToModel, WithHeadingRow, WithSkipDuplicates
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $ward_id, $room_id;

    public function __construct(int $ward_id, int $room_id)
    {
        $this->ward_id = $ward_id;
        $this->room_id = $room_id;
    }
    public function model(array $row)
    {
        //'ward_id', 'room_id', 'code', 'bed_status', 'display_name', 'is_dummy_room', 'is_oxygen', 'is_suction',
        //'is_window', 'created_by_id', 'updated_by_id'
        $count = Bed::where('ward_id', $this->ward_id)->where('room_id', $this->room_id)->where('code', $row['code'])->count();
        if ($count == 0) {
            return new Bed([
                'ward_id' => $this->ward_id,
                'room_id' => $this->room_id,
                'code' => $row['code'],
                'name' => $row['name'],
                'is_dummy_room' => $row['dummy'],
                'is_oxygen' => $row['oxygen'],
                'is_suction' => $row['suction'],
                'is_window' => $row['window'],
                'created_by_id' => Auth::user()?->id,
                'updated_by_id' => Auth::user()?->id
            ]);
        }
    }
}

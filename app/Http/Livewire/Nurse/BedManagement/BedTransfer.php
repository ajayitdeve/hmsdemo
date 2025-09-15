<?php

namespace App\Http\Livewire\Nurse\BedManagement;

use App\Models\CostCenter;
use App\Models\Ipd\Bed;
use App\Models\Ipd\Ipd;
use App\Models\Ipd\PatientBed;
use App\Models\Ipd\Room;
use App\Models\Ipd\Ward;
use App\Models\User;
use App\Traits\NurseDepartment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BedTransfer extends Component
{
    use NurseDepartment;

    public $bg_color, $ipd, $ipd_code;
    public $umr, $patient_name, $age, $gender, $status, $admn_no, $consultant, $patient_type, $corporate_name, $admn_date;
    public $ward, $room, $bed, $from_date;
    public $cost_center_id, $ward_id, $room_id, $bed_id;

    public $transfer_date, $transfer_time, $authorized_by_id, $reason;
    public $cost_centers = [], $wards = [], $rooms = [], $beds = [], $roomBeds = [], $users = [];
    public $bed_transfer_list = [];


    public function rules(): array
    {
        return [
            'umr' => 'required',
            'cost_center_id' => 'required',
            'ward_id' => 'required',
            'room_id' => 'required',
            'bed_id' => 'required',
            'authorized_by_id' => 'required',
            'reason' => 'required',
        ];
    }

    public function mount($ipd_code)
    {
        $this->ipd_code = $ipd_code;
        $this->checkNurseStationSession();

        $this->cost_centers = CostCenter::all();
        $this->wards = Ward::all();
        $this->users = User::all();


        $ipd = Ipd::with(
            [
                "bed",
                "room" => function ($query) {
                    $query->where("nurse_station_id", session()->get("nurse_station_id"));
                },
                "patient_visit" => function ($query) {
                    $query->with(['doctor']);
                },
                "patient" => function ($query) {
                    $query->with(['gender']);
                }
            ]
        )
            ->whereHas("room", function ($query) {
                $query->where("nurse_station_id", session()->get("nurse_station_id"));
            })
            ->where("ipdcode", $this->ipd_code)
            ->first();

        if ($ipd) {
            $this->ipd = $ipd;

            $this->umr = $ipd?->patient?->registration_no;
            $this->patient_name = $ipd?->patient?->name;
            $this->status = "Not Approved";
            $this->patient_type = $ipd?->patient?->patienttype->name;
            $this->age = Carbon::parse($ipd?->patient?->dob)->diff(Carbon::now())->format('%y years, %m months and %d days');
            $this->gender = $ipd?->patient?->gender?->name;
            $this->ward = $ipd?->ward?->name;
            $this->room = $ipd?->room?->name;
            $this->bed = $ipd?->bed?->display_name;
            $this->admn_no = $ipd->ipdcode;
            $this->admn_date = date("Y-m-d H:i", strtotime($ipd->created_at));
            $this->consultant = $ipd?->patient_visit?->doctor?->name;

            $this->corporate_name = $ipd?->corporate_registration?->organization?->name;
            $this->bg_color = "#" . $ipd?->corporate_registration?->organization?->color;

            $this->cost_center_id = $ipd?->cost_center_id;

            $this->transfer_date = date("Y-m-d");
            $this->transfer_time = date("H:i");

            $this->bed_transfer_list = PatientBed::with(["ward", "room", "bed", "updated_by"])
                ->where("ipd_id",  $this->ipd?->id)
                ->latest()
                ->get();
        }
    }

    public function wardChanged()
    {
        $this->rooms = [];
        $this->beds = [];
        $this->rooms = Room::where('ward_id', $this->ward_id)->get();
    }

    public function roomChanged()
    {
        $this->beds = [];
        $this->beds = Bed::where('room_id', $this->room_id)->where("bed_status", "vacant")->get();
        $this->getBedChart();
    }

    public function getBedChart()
    {
        if ($this->ward_id != null && $this->room_id != null) {
            $this->roomBeds = Bed::where('ward_id', $this->ward_id)->where('room_id', $this->room_id)->get();
        } else {
            $this->roomBeds = [];
        }
    }

    public function selectBed($id)
    {
        $this->bed_id = $id;
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent("close-modal");
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            Ipd::where('id', $this->ipd?->id)
                ->where('ipdcode', $this->ipd_code)
                ->update([
                    'cost_center_id' => $this->cost_center_id,
                    'ward_id' => $this->ward_id,
                    'room_id' => $this->room_id,
                    'bed_id' => $this->bed_id,
                ]);

            PatientBed::where('ipd_id', $this->ipd?->id)->latest()->first()->update([
                'to' => date('Y-m-d H:i:s'),
                'is_transfer' => 1,
            ]);

            PatientBed::create([
                'ipd_id' => $this->ipd?->id,
                'ward_id' => $this->ward_id,
                'room_id' => $this->room_id,
                'bed_id' => $this->bed_id,
                'from' => date("Y-m-d H:i:s"),
                'to' => null,
                'is_ipd_allocation' => 0,
                'is_transfer' => 0,
                'transfer_narration' => $this->reason,
                'updated_by_id' => $this->authorized_by_id,
            ]);


            Bed::where('id', $this->ipd?->bed_id)->update([
                'bed_status' => 'vacant',
            ]);

            Bed::where('id', $this->bed_id)->update([
                'bed_status' => 'used',
            ]);

            DB::commit();


            $this->bed_transfer_list = PatientBed::with(["ward", "room", "bed", "updated_by"])
                ->where("ipd_id",  $this->ipd?->id)
                ->latest()
                ->get();

            session()->flash('success', 'Bed transferred successfully.');

            return redirect()->route('admin.nurse.bed-management.bed-transfer', $this->ipd_code);
        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.nurse.bed-management.bed-transfer')->extends('layouts.admin')->section('content');
    }
}

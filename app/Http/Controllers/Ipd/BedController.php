<?php

namespace App\Http\Controllers\Ipd;

use App\Http\Controllers\Controller;
use App\Imports\BedImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function import_beds_form(Request $request)
    {
        $ward_id = $request->segment(4);
        $room_id = $request->segment(5);


        return view('admin.ipd.bed.import-beds-form', ['ward_id' => $ward_id, 'room_id' => $room_id]);
    }
    public function import_beds(Request $request)
    {
        Excel::import(new BedImport($request->ward_id, $request->room_id), $request->file('file'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Mrq;
use Illuminate\Http\Request;

class MrqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function show(Mrq $mrq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mrq $mrq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mrq $mrq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mrq $mrq)
    {
        //
    }

    public function print($mrq_id)
    {
        $mrq = Mrq::find($mrq_id);
        // dd($gin->ginitems);
        return view("admin.mrq.print-mrq", compact("mrq"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\SaleStore;
use Illuminate\Http\Request;

class SaleStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $salestores = SaleStore::orderBy("id","desc")->get();
       return view("admin.salestore.index", compact("salestores"));
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
    public function show(SaleStore $saleStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleStore $saleStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleStore $saleStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleStore $saleStore)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Gin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function createGin(Request $request)
    {
        //get mrq by id
        $mrq = \App\Models\Mrq::find($request->mrq_id);
        //Gin code
        $ginCode = $this->getCode(Gin::max('id'));
        $gin = Gin::create([
            'stock_point_id' => $mrq->stock_point_from_id,
            'mrq_id' => $request->mrq_id,
            'code' => $ginCode,
            'status' => true,
            'remarks' => 'approved',
        ]);

        // foreach($mrq->mrqitems as $mrqitem){
        //     \App\Models\GinItem::create([
        //         'stock_point_id'=>$mrq->stock_point_from_id,
        //         'gin_id'=>$gin->id,
        //     ]);
        // }
        return redirect()->route('admin.gin.create-gin-items', $gin->id);
    }
    protected function getCode($maxId)
    {
        $maxId = $maxId + 1;
        if ($maxId < 10)
            return 'GIN00' . $maxId;
        else if ($maxId >= 10 && $maxId < 100)
            return 'GIN0' . $maxId;
        else if ($maxId >= 100)
            return 'GIN' . $maxId;
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
    public function show(Gin $gin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gin $gin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gin $gin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gin $gin)
    {
        //
    }
    public function print($gin_id)
    {

        $gin = Gin::find($gin_id);
        if ($gin->status == 0) {
            //approve
            $gin->update(['status' => 1, 'approved_by_id' => Auth::user()?->id]);
            return view("admin.gin.print-gin", compact("gin"));
        } else {
            return view("admin.gin.print-gin", compact("gin"));
        }
        // dd($gin->ginitems);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ReboursementDecouvert;
use App\Models\Decouvert;
use Illuminate\Http\Request;
use App\Http\Requests\FormRemboursementRequest;

class ReboursementDecouvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reboursementDecouverts = ReboursementDecouvert::sortable()->paginate(20);
            
        return view('reboursementDecouverts.index', compact('reboursementDecouverts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reboursementDecouvert = new ReboursementDecouvert();

        return view('reboursementDecouverts.create',compact('reboursementDecouvert'));
    }

    public function ajaxfindDecouvert(){
        $compte_name = \Request::get('compte_name'); 

        $decouverts = 
        Decouvert::where('compte_name','=', $compte_name)
                    ->where('paye','=',0)
                    ->get();

         return response()->json(['decouverts'=> $decouverts]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       ReboursementDecouvert::create($request->all());

       return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function show(ReboursementDecouvert $reboursementDecouvert)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function edit(ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }
}

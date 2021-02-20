<?php

namespace App\Http\Controllers;

use App\kirimbaOperation;
use Illuminate\Http\Request;

class KirimbaOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('kirimba.operations');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\kirimbaOperation  $kirimbaOperation
     * @return \Illuminate\Http\Response
     */
    public function show(kirimbaOperation $kirimbaOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\kirimbaOperation  $kirimbaOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(kirimbaOperation $kirimbaOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\kirimbaOperation  $kirimbaOperation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, kirimbaOperation $kirimbaOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\kirimbaOperation  $kirimbaOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(kirimbaOperation $kirimbaOperation)
    {
        //
    }
}

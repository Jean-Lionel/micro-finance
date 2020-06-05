<?php

namespace App\Http\Controllers;

use App\Models\CopdiCompte;
use Illuminate\Http\Request;

class CopdiCompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $copdiComptes = CopdiCompte::sortable(['created_at' => 'DESC'])->paginate(5);

        return view('copdicomptes.index', compact('copdiComptes'));
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
     * @param  \App\CopdiCompte  $copdiCompte
     * @return \Illuminate\Http\Response
     */
    public function show(CopdiCompte $copdiCompte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CopdiCompte  $copdiCompte
     * @return \Illuminate\Http\Response
     */
    public function edit(CopdiCompte $copdiCompte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CopdiCompte  $copdiCompte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CopdiCompte $copdiCompte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CopdiCompte  $copdiCompte
     * @return \Illuminate\Http\Response
     */
    public function destroy(CopdiCompte $copdiCompte)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Requests\FormCompteRequest;

class CompteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comptes = Compte::sortable()->paginate(20);
        
        return view('comptes.index', compact('comptes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $compte = new Compte;
       return view('comptes.create',compact('compte'));
    }

    public function createCompte($client_id){

        $client = Client::where('id',$client_id)->firstOrFail();

        $compte = new Compte;
       return view('comptes.create',compact('compte','client'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormCompteRequest $request)
    {
        Compte::create($request->all());

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function show(Compte $compte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function edit(Compte $compte)
    {

       return view('comptes.edit',compact('compte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function update(FormCompteRequest $request, Compte $compte)
    {

        
        $compte->update($request->all());

        return $this->index();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compte  $compte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compte $compte)
    {
        //
    }
}

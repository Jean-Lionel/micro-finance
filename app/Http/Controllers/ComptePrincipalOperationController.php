<?php

namespace App\Http\Controllers;

use App\Models\ComptePrincipalOperation;
use Illuminate\Http\Request;
use Sabberworm\CSS\Parsing\strtolower;

class ComptePrincipalOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    *La function enregistre le movement faite sur le compte principale
     Type d'operation et le montant
    **/

    public static function storeOperation($montant, $typeOperation,$compte_name=''){

        // dump($typeOperation);

        // dd($montant);

        $typeOperation = strtolower($typeOperation);
        
         ComptePrincipalOperation::create([
            $typeOperation => $montant,
            'compte_name' => $compte_name
         ]);
         
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComptePrincipalOperation  $comptePrincipalOperation
     * @return \Illuminate\Http\Response
     */
    public function show(ComptePrincipalOperation $comptePrincipalOperation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComptePrincipalOperation  $comptePrincipalOperation
     * @return \Illuminate\Http\Response
     */
    public function edit(ComptePrincipalOperation $comptePrincipalOperation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ComptePrincipalOperation  $comptePrincipalOperation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ComptePrincipalOperation $comptePrincipalOperation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComptePrincipalOperation  $comptePrincipalOperation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComptePrincipalOperation $comptePrincipalOperation)
    {
        //
    }
}

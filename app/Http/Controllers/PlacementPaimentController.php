<?php

namespace App\Http\Controllers;

use App\Models\ComptePlacement;
use App\Models\PlacementPaiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacementPaimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $search = \Request::get('search');
        $placement_paiments = PlacementPaiment::sortable()->latest()->paginate(10);

        return view('placementPaiement.index',compact('placement_paiments','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $placement_paiment = new PlacementPaiment;
        return view('placementPaiement.create', compact('placement_paiment'));   

     }

    /**
     * Store a newly created resource in storage.
     *
date_paiment
compte_name
compte_placement_id
client_id
user_id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'compte_name' => 'required|exists:compte_placements,name',
            'client_id' => 'required|exists:placement_clients,id',
            'montant' => 'required|numeric|min:0',
            'date_paiment' => 'required|date',

        ]);
       // dd($request->all());

        try {
            DB::beginTransaction();

            $compte = ComptePlacement::where('name','=',$request->compte_name)->firstOrFail();
            // dd( $compte->id);

            if($compte->montant > $request->montant){

             ComptePrincipalController::store_info(abs($request->montant), 'MOINS');


             $new_monant = $compte->montant - abs($request->montant);
              $compte->update(['montant' => $new_monant]);


            ComptePrincipalOperationController::storeOperation(abs($request->montant), 'paiment_placement',$compte->name );

            PlacementPaiment::create(
                array_merge($request->all(), ['compte_placement_id' =>  $compte->id])
               
            );

            PlacementCompteOperation::create([
                
                'type_operation' => 'PAIMENT DE PLACEMENT',
                'compte_name' => $compte->name,
                'montant' => $request->montant,
                'placement' => 'jean lionel'


            ]);

             DB::commit();

        }else{
            errorMessage("Error le montant sur ce compte est insufisant");
        }
      
        } catch (\Exception $e) {

            DB::rollBack();
           
        }

        successMessage();

        return $this->index();


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PlacementPaiment  $placementPaiment
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementPaiment $placementPaiment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PlacementPaiment  $placementPaiment
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementPaiment $placementPaiment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PlacementPaiment  $placementPaiment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacementPaiment $placementPaiment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PlacementPaiment  $placementPaiment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementPaiment $placementPaiment)
    {
        //
    }
}

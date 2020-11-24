<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormDecouvertRequest;
use App\Models\ComptePrincipalOperation;
use App\Models\Decouvert;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\back;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DecouvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$decouverts = Decouvert::sortable()->paginate(10);

        $search = \Request::get('search'); 

        $decouverts = Decouvert::sortable()
        ->where('compte_name','like','%'.$search.'%')
        ->orWhere('montant','like','%'.$search.'%')
        ->orWhere('interet','like','%'.$search.'%')
        ->orWhere('total_a_rambourse','like','%'.$search.'%')
        ->orWhere('periode','like','%'.$search.'%')
        ->orWhere('montant_payer','like','%'.$search.'%')
        ->orWhere('montant_restant','like','%'.$search.'%')
        ->orWhere('created_at','like','%'.$search.'%')
        ->paginate(10);


        return view('decouverts.index', compact('decouverts','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $decouvert = new Decouvert;

        return view('decouverts.create',compact('decouvert'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormDecouvertRequest $request)
    {
        //Calculer de l'interet total
        $total_a_rambourse = 
        $request->montant + ((($request->montant * $request->interet)/100) *  $request->periode);

        try {
            DB::beginTransaction();
    // database queries here

            ComptePrincipalController::store_info($request->montant, 'DECOUVERT');

            Decouvert::create([
                'compte_name' => $request->compte_name,
                'montant' => $request->montant,
                'interet' => $request->interet,
                'periode' => $request->periode,
                'total_a_rambourse' => $total_a_rambourse,
                'montant_restant' => $total_a_rambourse
            ]);

            ComptePrincipalOperationController::storeOperation($request->montant, 'DECOUVERT',$request->compte_name);

            DB::commit();
            successMessage();
        } catch (\Exception $e) {
    // Woopsy
            DB::rollBack();
            errorMessage("Opération échoué car ".$e->getMessage());

        }

        

        return $this->index();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Decouvert  $decouvert
     * @return \Illuminate\Http\Response
     */
    public function show(Decouvert $decouvert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Decouvert  $decouvert
     * @return \Illuminate\Http\Response
     */
    public function edit(Decouvert $decouvert)
    {
        return view('decouverts.edit', compact('decouvert'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Decouvert  $decouvert
     * @return \Illuminate\Http\Response
     */
    public function update(FormDecouvertRequest $request, Decouvert $decouvert)
    {
        //TODO
        //Ajouter le montant sur le compte principal

        //Enelever le nouveau Montant 

        //Modifier le Decouvert 

        //Modifier sur le compte principal operation




        try {

          DB::beginTransaction();

          $total_a_rambourse = 
          $request->montant + ((($request->montant * $request->interet)/100) *  $request->periode);

        // Compter Principal Operation 
        //SELECT `montant`,`compte_name`,`created_at` FROM `decouverts` WHERE compte_name like 'coo-1'

          $compte_principal_op = ComptePrincipalOperation::where('compte_name','=', $request->compte_name)
          ->where('decouvert','=',$decouvert->montant)
          ->whereDate('created_at','=',$decouvert->created_at)
          ->first();

          if($compte_principal_op){
             //Ajout du montant sur le compte principal

            ComptePrincipalController::store_info($compte_principal_op->decouvert, 'ADD');

            $compte_principal_op->update([
                        'decouvert' => $request->montant
                    ]);

            ComptePrincipalController::store_info($request->montant, 'DECOUVERT');
            $decouvert->update(
                [
                'montant' => $request->montant,
                'interet' => $request->interet,
                'periode' => $request->periode,
                'total_a_rambourse' => $total_a_rambourse,
                'montant_restant' => $total_a_rambourse

            ]);

          }

          DB::commit();
          successMessage();

      } catch (\Exception $e) {

         DB::rollBack();
         errorMessage("Opération échoué car ".$e->getMessage());

     }





        // $total_a_rambourse = 
        // $request->montant + 
        // ((($request->montant * $request->interet)/100) * $request->periode);

        // $decouvert->update(
        //     [
        //         'compte_name' => $request->compte_name,
        //         'montant' => $request->montant,
        //         'interet' => $request->interet,
        //         'periode' => $request->periode,
        //         'total_a_rambourse' => $total_a_rambourse ,
        //         'montant_restant' => $total_a_rambourse
        //     ]

        // );

     // errorMessage("On ne peut pas Modifier une decouvert qu'a déjà attribué  ");

     return $this->index();
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Decouvert  $decouvert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decouvert $decouvert)
    {
        //
    }
}

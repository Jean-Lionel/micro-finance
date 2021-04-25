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
        $decouverts = Decouvert::sortable()->latest()
        ->where('compte_name','=',$search)
        ->orWhere('created_at','like','%'.$search.'%')
        ->paginate();
        //TOTAL DES RECOUVREMENT
        $now = date('Y-m-d');
         $total = DB::select("select count(*) as nombre_total from `decouverts` where `paye` = 0 and date(`date_fin`) < '$now' and `decouverts`.`deleted_at` is null");

        $nombre_total = $total[0]->nombre_total;

        return view('decouverts.index', compact('decouverts','search','nombre_total'));
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
            $date_fin = new Carbon();
            $date_fin = $date_fin->addMonths($request->periode);
            Decouvert::create([
                'compte_name' => $request->compte_name,
                'montant' => $request->montant,
                'interet' => $request->interet,
                'periode' => $request->periode,
                'date_fin' =>   $date_fin,
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
        return view("decouverts.show" , compact('decouvert'));
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
          ->firstOrFail();

          if($compte_principal_op){
             //Ajout du montant sur le compte principal

            ComptePrincipalController::store_info($compte_principal_op->decouvert, 'ADD');

            $compte_principal_op->update([
                        'decouvert' => $request->montant
                    ]);

            ComptePrincipalController::store_info($request->montant, 'DECOUVERT');
             $date_fin = new Carbon();
             $date_fin = $date_fin->addMonths($request->periode);
            $decouvert->update(
                [
                'montant' => $request->montant,
                'interet' => $request->interet,
                'periode' => $request->periode,
                'date_fin' => $date_fin,
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


     return $this->index();
    }

    public function recrouvement(){

        $search = \Request::get('search'); 

        $now = Carbon::now();
        $decouverts =  Decouvert::where("paye",'=',0)
                                ->where(function($query) use ($search){
                                    if(strlen($search) > 4){
                                        $query->where('compte_name', '=',$search );
                                    }
                                })
                                ->whereDate('date_fin', '<', $now)->paginate(); 
        $total = DB::select("select count(*) as nombre_total from `decouverts` where `paye` = 0 and date(`date_fin`) < '$now' and `decouverts`.`deleted_at` is null");

        $nombre_total = $total[0]->nombre_total;
        //dd("OK");
        return view("decouverts.recrouvement", compact('decouverts','nombre_total','search'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Decouvert  $decouvert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Decouvert $decouvert)
    {

       // ComptePrincipalController: Ajouter le montant sur le compte principal
        //Decouvert : SUpprimer Le decouvert
        //ComptePrincipalOperationController: ENregistrer l'operation

        try {

             DB::beginTransaction();


         ComptePrincipalController::store_info($decouvert->montant,'ADD');


          $compte_principal_op = ComptePrincipalOperation::where('compte_name','=', $decouvert->compte_name)
          ->where('decouvert','=',$decouvert->montant)
          ->whereDate('created_at','=',$decouvert->created_at)
          ->firstOrFail();


          $compte_principal_op->delete();

          $decouvert->delete();


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            errorMessage($e->getMessage());
            return back();
            
        }

        successMessage();

        return back();
    }
}

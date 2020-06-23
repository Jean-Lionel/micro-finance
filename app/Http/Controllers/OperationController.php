<?php

namespace App\Http\Controllers;

use  App\Http\Controllers\OperationController;
use  MercurySeries\Flashy\Flashy;
use App\Http\Controllers\ComptePrincipalOperationController;
use App\Http\Requests\FormOperationRequest;
use App\Models\Compte;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {

        $search = \Request::get('search');
        $operations = Operation::sortable(['created_at'=>'desc'])
        ->where('compte_name', 'like', '%'.$search.'%')
        ->orWhere('operer_par', 'like', '%'.$search.'%')
        ->orWhere('montant', 'like', '%'.$search.'%')
        ->orWhere('type_operation', 'like', '%'.$search.'%')
        ->orWhere('user_id', 'like', '%'.$search.'%')
        ->orWhere('cni', 'like', '%'.$search.'%')
        ->paginate(10);

        //dd($operations);

        return view('operations.index',compact('operations','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
        //
        $operation = new Operation;

        return view('operations.create',compact('operation'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(FormOperationRequest $request)
     {



        $compte = Compte::where('name','=',$request->compte_name)->firstOrFail();

        $current_sum = $compte->montant;

        if($request->type_operation == 'RETRAIT'){

            if($current_sum > $request->montant){
                //Modification du compte client
                //Actualisation du compte principal de banque
                $resp = ComptePrincipalController::update($request->montant,'RETRAIT');
                //Response du compte principal

                
                if($resp == 'OK'){
                 
                 $newValue = $current_sum - $request->montant;
                 $compte->update(['montant' => $newValue]);
                 ComptePrincipalOperationController::storeOpertation($request->montant, 'retrait');
                 Operation::create($request->all());
                 //Message
                 successMessage();
                 }else{
                //TO DO on ffiche pour le moment la reponse du compte principal
                flashy()->error($resp);

                 $operation = new Operation($request->all());
                 
                return view('operations.create',compact('operation'));;

                //return $resp;
            }


            }else{

                $operation = new Operation($request->all());
                flashy()->error('Le solde demande est insuffisant sur vôtre compte');
                return view('operations.create',compact('operation'));;
            }

        }
        else if($request->type_operation == 'VERSEMENT'){
            $newValue = $current_sum  + $request->montant;
                //Modification du compte principale
                $resp = ComptePrincipalController::update($request->montant,'VERSEMENT');

                if($resp){
                 $compte->update(['montant' => $newValue]);
                     //'retrait','versement'
                     ComptePrincipalOperationController::storeOpertation($request->montant, 'versement');
                //Actualisation du compte principal
                Operation::create($request->all());
                flashy()->success('Opération réussi');
                }else{
                    flashy()->error($resp);
                    dump($resp);
                }

            }


            return $this->index();


        }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
     public function show(Operation $operation)
     {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
     public function edit(Operation $operation)
     {
        return view('operations.edit',compact('operation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
     public function update(FormOperationRequest $request, Operation $operation)
     {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
     public function destroy(Operation $operation)
     {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Compte;
use App\Models\Operation;
use Illuminate\Http\Request;
use App\Models\CaisseCaissier;
use  MercurySeries\Flashy\Flashy;
use App\Models\TenuCompteurWatch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\FormOperationRequest;
use  App\Http\Controllers\OperationController;
use App\Http\Controllers\ComptePrincipalOperationController;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        // $sum = Operation::where('type_operation','=','VERSEMENT')->sum('montant');
        // $retrait = Operation::where('type_operation','=','RETRAIT')->sum('montant');
        // dump($sum);
        // dump($retrait);
        // dd('FIN');
        $search = \Request::get('search');
        if(Gate::allows('is-admin')){
            $operations = Operation::sortable(['created_at'=>'desc'])
            ->where('compte_name', 'like', '%'.$search.'%')
            ->orWhere('operer_par', 'like', '%'.$search.'%')
            ->orWhere('montant', 'like', '%'.$search.'%')
            ->orWhere('type_operation', 'like', '%'.$search.'%')
            ->orWhere('user_id', 'like', '%'.$search.'%')
            ->orWhere('cni', 'like', '%'.$search.'%')
            ->paginate(10);

        }
        if(Gate::denies('is-admin')){
           $operations = Operation::sortable(['created_at'=>'desc'])
           ->where('compte_name', 'like', '%'.$search.'%')
           ->where('user_id','=', Auth::user()->id)
           ->paginate(10);

       }
       $user_id = Auth::user()->id;
       $versement = Operation::where('user_id',$user_id)
       ->where('type_operation','=','VERSEMENT')
       ->whereDate('created_at',Carbon::now())->sum('montant');
       $retrait = Operation::where('user_id',$user_id)
       ->where('type_operation','=','RETRAIT')
       ->whereDate('created_at',Carbon::now())->sum('montant');

       $montant_caisse = CaisseCaissier::where('user_id',$user_id)->sum('montant');

        // dd($operations);
        
        // TAKE TENU DE COMPTE 
        
      //  TenuCompteurWatch::takeTenuCompte();

       return view('operations.index',compact('operations','search', 'versement','retrait','montant_caisse'));
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
     * @return \Illuminate\Http\Response FormOperationRequest
     */

    public function isAutorized($request)
    {

         // dump(Gate::denies('is-admin'));
        if(Gate::denies('is-admin')){
            //dump(Gate::allows('is-versement-user'));
           if(Gate::denies('is-retrait-user') && ($request->type_operation == 'RETRAIT')){
            return response()->json(['error'=> "Vous essayez de faire une action dont vous n'avez le droit"]);
        }

        if(Gate::denies('is-versement-user') && ($request->type_operation == 'VERSEMENT')){
            return response()->json(['error'=> "Vous essayez de faire une action dont vous n'avez le droit"]);
        }

    }

}

public function store(Request $request){

    //Verfication des autorisation
 if(Gate::denies('is-admin')){
            //dump(Gate::allows('is-versement-user'));
   if(Gate::denies('is-retrait-user') && ($request->type_operation == 'RETRAIT')){
    return response()->json(['error'=> "Vous essayez de faire une action dont vous n'avez le droit"]);
}

if(Gate::denies('is-versement-user') && ($request->type_operation == 'VERSEMENT')){
    return response()->json(['error'=> "Vous essayez de faire une action dont vous n'avez le droit"]);
}

}
    //FIN
try {
   $compte = Compte::where('name','=',$request->compte_name)->firstOrFail();

} catch (\Exception $e) {

   return response()->json(['error'=> "Vérifier le numéro de compte"]);

}



if($compte){

    if($request->type_operation == 'RETRAIT'){
                //TODO
                //Verification que le montant est suffisant sur le compte en question
        if($compte->montant > $request->montant){

            try {

                DB::beginTransaction();
                ComptePrincipalController::store_info($request->montant, 'RETRAIT');

                $new_monant = $compte->montant - $request->montant;

                $compte->update(['montant' => $new_monant]);

                ComptePrincipalOperationController::storeOperation($request->montant, 'retrait',$compte->name );

                $request->montant = $request->montant;

                Operation::create($request->all());

                DB::commit();

                return response()->json(['success'=>'Opération réussi']);

            } catch (\Exception $e) {
                DB::rollback();

                return response()->json(['error'=>$e->getMessage()]);
            }

        }else{
           return response()->json(['error'=> 'Le solde demande est insuffisant sur vôtre compte']);
       }


   }


   if($request->type_operation == 'VERSEMENT'){


    try {

        DB::beginTransaction();

        ComptePrincipalController::store_info($request->montant, 'VERSEMENT');

        $new_monant = $compte->montant + $request->montant;

        $compte->update(['montant' => $new_monant]);

        ComptePrincipalOperationController::storeOperation($request->montant, 'VERSEMENT',$compte->name);

        $request->montant = $request->montant;

        Operation::create($request->all());

        DB::commit();
        return response()->json(['success'=>'Opération réussi']);
    } catch (\Exception $e) {
        DB::rollback();
        return response()->json(['error'=>$e->getMessage()]);

    }
}

}

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
        if(Gate::denies('is-admin')){

            errorMessage("Vous n'êtes pas autorisé a faire cette action");
            return $this->index();
        }

        try {
            DB::begintransaction();
           // if(Carbon::today() == $operation->created_at;


            if(Carbon::today()->format('Y-m-d') !== $operation->created_at->format('Y-m-d')){
                throw new \Exception("impossible d'annulé les opérations des jours antérieur !! 🔒", 1);

            }

            $compte = Compte::where('name',$operation->compte_name)->firstOrFail();
             $user = User::find($operation->user_id);
            $type_operation = $operation->type_operation;

            if($type_operation == 'VERSEMENT'){

            
                 if($user->caisse->montant < $operation->montant)
                    throw new \Exception("L'annulation de cette opération est impossible car le montant est insuffisant sur son compte",2);
                //On enleve le montant sur son compte
                 $user->caisse->montant -= $operation->montant;
                 $user->caisse->save();
                   // `annulation_versement`, `annulation_retrait`
                ComptePrincipalController::store_info(abs($operation->montant), 'ANNULATION_VERSEMENT');
                ComptePrincipalOperationController::storeOperation(abs($operation->montant), 'annulation_versement',$operation->compte_name);

                $operation->delete();
                $compte->montant = $compte->montant - abs($operation->montant);


                $compte->save();

            }

            if($type_operation == 'RETRAIT'){
               ComptePrincipalController::store_info(abs($operation->montant), 'ANNULATION_RETRAIT');
               ComptePrincipalOperationController::storeOperation(abs($operation->montant), 'annulation_retrait',$operation->compte_name);
               // On ajouter le montant sur son compte 
                $user->caisse->montant += $operation->montant;
                 $user->caisse->save();
               $operation->delete();

               $compte->montant = $compte->montant + abs($operation->montant);
               $compte->save();


           }

           successMessage();


           DB::commit();

       } catch (\Exception $e) {

        DB::rollback();

            // dd($e);

        errorMessage($e->getMessage());

    }



    return $this->index();


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

    public function operation_details()
    {
     $op_id = \Request::get('id');

     $operation = Operation::where('id','=',$op_id)->first();

        // $user = User::where('id','=',$operation->user_id);

        // dump($operation);



     return $operation ? response()->json(
        [
            'operation'=> $operation ,
            'user' => $operation->user,
            'agence_name' => $operation->user->agence->name,

        ]) : response()->json(['error'=> 'ivalid id']) ;
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

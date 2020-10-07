<?php

namespace App\Http\Controllers;

use  App\Http\Controllers\OperationController;
use  MercurySeries\Flashy\Flashy;
use App\Http\Controllers\ComptePrincipalOperationController;
use App\Http\Requests\FormOperationRequest;
use App\Models\Compte;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

        // dd($operations);

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

        if($compte->montant > abs($request->montant)){

            try {

                DB::beginTransaction();

                ComptePrincipalController::store_info(abs($request->montant), 'RETRAIT');

                $new_monant = $compte->montant - abs($request->montant);

                $compte->update(['montant' => $new_monant]);

                ComptePrincipalOperationController::storeOperation(abs($request->montant), 'retrait',$compte->name );

                $request->montant = abs($request->montant);

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

        ComptePrincipalController::store_info(abs($request->montant), 'VERSEMENT');

        $new_monant = $compte->montant + abs($request->montant);

        $compte->update(['montant' => $new_monant]);

        ComptePrincipalOperationController::storeOperation(abs($request->montant), 'VERSEMENT',$compte->name);

        $request->montant = abs($request->montant);

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

            $compte = Compte::where('name',$operation->compte_name)->firstOrFail();


            $type_operation = $operation->type_operation;

            if($type_operation == 'VERSEMENT'){

                   // `annulation_versement`, `annulation_retrait`

                ComptePrincipalController::store_info(abs($operation->montant), 'MOINS');
                ComptePrincipalOperationController::storeOperation(abs($operation->montant), 'annulation_versement',$operation->compte_name);

                $operation->delete();
                $compte->montant = $compte->montant - abs($operation->montant);


                $compte->save();

            }

            if($type_operation == 'RETRAIT'){
             ComptePrincipalController::store_info(abs($operation->montant), 'ADD');
             ComptePrincipalOperationController::storeOperation(abs($operation->montant), 'annulation_retrait',$operation->compte_name);

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
            'user' => $operation->user

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

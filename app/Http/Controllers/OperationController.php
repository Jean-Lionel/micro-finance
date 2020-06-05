
<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormOperationRequest;
use App\Models\Compte;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = Operation::sortable()->paginate(40);

        //dd($operations);

        return view('operations.index',compact('operations'));
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


        $compte = Compte::where('id',$request->compte_id)->first();


       if($compte){
         $montant = $request->montant;
        
        if($request->type_operation == 'VERSEMENT'){
            $compte->montant =  $compte->montant + $montant ;

             $compte->save();
        }

        if($request->type_operation == 'RETRAIT'){
             if( $compte->montant >= $montant  ){
                $compte->montant = $compte->montant - $montant;

             }else{
                //todo 
                return back();

             }
             
        }

        $compte->save();

       // dd( $compte);
       Operation::create($request->all());
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
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

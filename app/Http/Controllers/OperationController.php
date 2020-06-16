<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormOperationRequest;
use App\Models\Compte;
use App\Models\Operation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  MercurySeries\Flashy\Flashy;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $operations = Operation::sortable('date')->paginate(10);

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

        //flashy()->success('You have been logged out.', 'http://your-awesome-link.com');

        $compte = Compte::where('name','=',$request->compte_name)->firstOrFail();

        $current_sum = $compte->montant;

        if($request->type_operation == 'RETRAIT'){

            if($current_sum > $request->montant){
                $newValue = $current_sum - $request->montant;
                //Modification du compte principale
                $compte->update(['montant' => $newValue]);

            }else{

                $operation = new Operation($request->all());

                return view('operations.create',compact('operation'));;
            }

        }
        else if($request->type_operation == 'VERSEMENT'){
            $newValue = $current_sum  + $request->montant;
                //Modification du compte principale
             $compte->update(['montant' => $newValue]);

        }

        Operation::create($request->all());


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

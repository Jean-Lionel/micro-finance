<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormDecouvertRequest;
use App\Models\Decouvert;
use Illuminate\Http\Request;
use Illuminate\Routing\back;

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

        $response = ComptePrincipalController::update($request->montant, 'DECOUVERT');

        dd($response);

        if($response == "OK"){

            Decouvert::create([
            'compte_name' => $request->compte_name,
            'montant' => $request->montant,
            'interet' => $request->interet,
            'periode' => $request->periode,
            'total_a_rambourse' => $total_a_rambourse,
            'montant_restant' => $total_a_rambourse
            ]);

            ComptePrincipalOperationController::storeOpertation($request->montant, 'DECOUVERT');

            successMessage();

        }else{
            errorMessage($response);

            return back();
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
        $total_a_rambourse = 
        $request->montant + 
        ((($request->montant * $request->interet)/100) * $request->periode);

        $decouvert->update(
            [
            'compte_name' => $request->compte_name,
            'montant' => $request->montant,
            'interet' => $request->interet,
            'periode' => $request->periode,
            'total_a_rambourse' => $total_a_rambourse ,
            'montant_restant' => $total_a_rambourse
            ]

            );

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

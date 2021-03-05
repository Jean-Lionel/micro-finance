<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormRemboursementRequest;
use App\Models\Decouvert;
use App\Models\ReboursementDecouvert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class ReboursementDecouvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //   "montant" => "100000.0"
    // "interet" => "8.0"
    // "periode" => "3"
    // "total_a_rambourse" => "124000.0"
    // "montant_payer" => "0.0"
    // "montant_restant" => "0.0"
    // "paye" => "0"
    public function index()
    {
        $search = \Request::get('search'); 

        $reboursementDecouverts = ReboursementDecouvert::latest()->sortable()
            ->where('compte_name','like',$search.'%')
            ->paginate(20);

        return view('reboursementDecouverts.index', compact('reboursementDecouverts','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reboursementDecouvert = new ReboursementDecouvert();

        return view('reboursementDecouverts.create',compact('reboursementDecouvert'));
    }

    public function ajaxfindDecouvert(){
        $compte_name = \Request::get('compte_name'); 

        $decouverts = 
        Decouvert::where('compte_name','=', $compte_name)
        ->where('paye','=',0)
        ->get();



        return response()->json(['decouverts'=> $decouverts]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    try {
        $decouvert = Decouvert::where('id',$request->decouvert_id)->firstOrFail();
        
    } catch (\Exception $e) {

        errorMessage("Vérifier que vous avez saisit des information correctes ");

        return back();
        
    }

   

     $validate  = $request->validate([
        'montant' => 'required|numeric|max:'.$decouvert->montant_restant.'|min:0',
        'date_remboursement' => 'date|required']
    );


     //dd($request->montant);


     try {

        DB::beginTransaction();
        ComptePrincipalController::store_info($request->montant, 'REMBOURSEMENT');

        $montant_r = $decouvert->montant_restant - $request->montant;

        //Si le montant Restant est egale a zero on Fait la mise jour de paye
        $paye = $montant_r == 0 ? 1 : 0;

        $decouvert->update([
            'montant_restant' => $montant_r,
            'paye' => $paye
        ]);
        ReboursementDecouvert::create($request->all());

        ComptePrincipalOperationController::storeOperation($request->montant, 'reboursement',$request->compte_name);

        DB::commit();
        successMessage();
         
     } catch (\Exception $e) {

        DB::rollback();

        errorMessage($e->getMessage());

        return back();
         
     }

    return $this->index();
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function show(ReboursementDecouvert $reboursementDecouvert)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function edit(ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReboursementDecouvert  $reboursementDecouvert
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReboursementDecouvert $reboursementDecouvert)
    {
        //
    }
}

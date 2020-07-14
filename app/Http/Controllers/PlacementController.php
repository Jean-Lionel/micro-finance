<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormPlacementRequest;
use App\Models\PaiementPlacement;
use App\Models\Placement;
use Illuminate\Http\Request;
use Illuminate\Routing\back;
use Illuminate\Support\Carbon;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
        $search = \Request::get('search');


        $placements = Placement::sortable()
        ->where('montant','like', '%'.$search.'%')
        ->orWhere('compte_name','like', '%'.$search.'%')
        ->orWhere('date_placement','like', '%'.$search.'%')
        ->orWhere('interet_total','like', '%'.$search.'%')
        ->orWhere('nbre_moi','like', '%'.$search.'%')
        ->paginate(20);

        //dump(PaiementPlacement::payePlacementPaye(1));
        $now = Carbon::now();

        $placement_paye = Placement::where('date_fin','>=', $now )
                                    ->where('date_placement','<',$now)
                                     ->get();

        PaiementPlacement::paimentMensuellePlacement($placement_paye);

        return view('placements.index',compact('placements','search'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
        $placement = new Placement;

        return view('placements.create', compact('placement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(FormPlacementRequest $request)
     {
        $interet_total =( ($request->interet_total * $request->montant) / 100) * $request->nbre_moi;
        $place_interet = $request->montant + $interet_total;
        $interet_moi = $interet_total / $request->nbre_moi;

        //Verification sur le compte principal
        $response = ComptePrincipalController::update($request->montant,'PLACEMENT');

        //Date de fin pour le calculer la date de fin

        $date_pl = Carbon::create($request->date_placement);

        $date_fin = $date_pl->addMonths($request->nbre_moi);

        if($response  == 'OK'){

        ComptePrincipalOperationController::storeOperation($request->montant,'placement');
          Placement::create([
            'montant' => $request->montant,
            'compte_name' => $request->compte_name,
            'nbre_moi' => $request->nbre_moi,
            'interet_total' => $interet_total,
            'interet_Moi' => $interet_moi,
            'place_interet' => $place_interet,
            'date_placement' => $request->date_placement,
            'date_fin' => $date_fin,
            ]);

          successMessage();

          }else{
            //Message d'erreur 
           errorMessage($response);

            return back();
          }
      

      return $this->index();
      
  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
     public function show(Placement $placement)
     {

     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
     public function edit(Placement $placement)
     {
         return view('placements.edit',compact('placement'));
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Placement $placement)
     {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
     public function destroy(Placement $placement)
     {
        //
    }
}

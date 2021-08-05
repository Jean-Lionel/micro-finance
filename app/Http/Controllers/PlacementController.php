<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormPlacementRequest;
use App\Models\ComptePlacement;
use App\Models\ComptePrincipal;
use App\Models\ComptePrincipalOperation;
use App\Models\PaiementPlacement;
use App\Models\Placement;
use App\Models\PlacementCompteOperation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\back;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){

       // dump(Gate::allows('is-admin'));
       // dump(Gate::denies('placement-manager'));

       //  dump(Gate::authorize('placement-manager'));


       // dd();

    }
    public function index()
    {


        $search = \Request::get('search');



        $placements = Placement::sortable(['created_at'=>'desc'])
        ->where('montant','like', '%'.$search.'%')
        ->orWhere('compte_name','=', $search)
        ->orWhere('date_placement','like', '%'.$search.'%')
        ->orWhere('interet_total','like', '%'.$search.'%')
        ->orWhere('nbre_moi','like', '%'.$search.'%')
        ->paginate(20);


        //dump(PaiementPlacement::payePlacementPaye(1));
        // $now = Carbon::now();

        // dump(Carbon::today());
        // dd($now);

        //Rechercher des personnes dont les conditions de paiement sont respecter

        // $placement_paye = Placement::where('date_fin','>=', Carbon::today() )
        // ->whereDate('date_placement','<',$now)
        // ->whereMonth('date_placement','<',$now->month)
        // ->where('status','NON PAYE')
        // ->get();

         //dd($placement_paye);

        // PaiementPlacement::paimentMensuellePlacement($placement_paye);

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
        $interet_total =( ($request->interet * $request->montant) / 100) * $request->nbre_moi;
        $place_interet = $request->montant + $interet_total;
        $interet_moi = $interet_total / $request->nbre_moi;

        //using Trasaction Methode

        //Verification sur le compte principal
        //$response = ComptePrincipalController::update($request->montant,'PLACEMENT');

        try {
            DB::beginTransaction();
            $date_pl = Carbon::create($request->date_placement);

            $date_fin = $date_pl->addMonths($request->nbre_moi);
            
                    //dd($request->montant);

            ComptePrincipalController::store_info($request->montant,'PLACEMENT');
            ComptePrincipalOperationController::storeOperation($request->montant,'placement',$request->compte_name);

            $placement = Placement::create([
                'montant' => $request->montant,
                'compte_name' => $request->compte_name,
                'nbre_moi' => $request->nbre_moi,
                'interet_total' => $interet_total,
                'interet' => $request->interet,
                'interet_Moi' => $interet_moi,
                'place_interet' => $place_interet,
                'montant_restant' => $place_interet,
                'date_placement' => $request->date_placement,
                'date_fin' => $date_fin,
            ]);

            PlacementCompteOperation::create([

                'type_operation' => 'PLACEMENT',
                'compte_name' => $request->compte_name,
                'montant' => $request->montant,
                'placement' => $placement->id

            ]);

            $compte_placement = ComptePlacement::where('name','=',$request->compte_name)->firstOrFail();

            $compte_placement->update(['montant' =>($compte_placement->montant + abs($place_interet)) ]);

           //  dd($placement->attributes());

            
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
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function show()
    {


        //$placement->status = 'NON PAYE';

    }

    public function finaliser(Placement $placement)
    {

        try {
            DB::beginTransaction();

            ComptePrincipalController::store_info($placement->montant,'MOINS');
            ComptePrincipalOperationController::storeOperation($placement->montant,'paiment_placement',$placement->compte_name);
            $placement->status = 'DEJA PAYE';

            $placement->save();

            DB::commit();

            successMessage();
            
        } catch (\Exception $e) {
            DB::rollback();
            errorMessage($e->getMessage());
            
        }

        return back();

        
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
    public function update(FormPlacementRequest $request, Placement $placement)
    {
        //Enlever le montant sur le compte principal
        //Modifier

        try {

            DB::beginTransaction();

            $interet_total =( ($request->interet * $request->montant) / 100) * $request->nbre_moi;
            $place_interet = $request->montant + $interet_total;
            $interet_moi = $interet_total / $request->nbre_moi;

            $date_pl = Carbon::create($request->date_placement);

            $date_fin = $date_pl->addMonths($request->nbre_moi);

           //Modification de l'operation sur le compte principal


            $compte_principalOp = ComptePrincipalOperation::where('compte_name','=',$placement->compte_name)
            ->where('placement', '=',$placement->montant)
            ->whereDate('created_at','=',$placement->created_at)->first();


            if($compte_principalOp){
                ComptePrincipalController::store_info($compte_principalOp->placement, 'MOINS');

                ComptePrincipalController::store_info($request->montant, 'ADD');

                $compte_principalOp->update([
                    'placement' => $request->montant
                ]);


                $placement->update([

                 'montant' => $request->montant,
                 'nbre_moi' => $request->nbre_moi,
                 'interet_total' => $interet_total,
                 'interet' => $request->interet,
                 'interet_Moi' => $interet_moi,
                 'place_interet' => $place_interet,
                 'montant_restant' => $place_interet,
                 'date_placement' => $request->date_placement,
                 'date_fin' => $date_fin,


             ]);

            }

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
     * Remove the specified resource from storage.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placement $placement)
    {

        
        //La suppression se fait dans 5 tables 🚧

//         ComptePrincipalController // Enleve le montant sur le compte principal


// ComptePrincipalOperationController //Stocker l'operation
// Placement // Suppression du placement
// PlacementCompteOperation // Enregistrer l'operation
// ComptePlacement // Actualiser
// update 
// ComptePrincipalController::store_info($placement->montant,'MOINS');


        try {
            DB::beginTransaction();

            ComptePrincipalController::store_info($placement->montant,'MOINS');
            // ComptePrincipalOperationController::storeOperation($placement->montant,'suppression_placement',$placement->compte_name);


                 $compte_principalOp = ComptePrincipalOperation::where('compte_name','=',$placement->compte_name)
            ->where('placement', '=',$placement->montant)
            ->whereDate('created_at','=',$placement->created_at)->first();

             $compte_principalOp->delete();


            $op = PlacementCompteOperation::where('placement', $placement->id)->firstOrFail();

            $op->delete();

              $compte_placement = ComptePlacement::where('name','=',$placement->compte_name)->firstOrFail();

            if($compte_placement->montant >= $placement->montant){

                $compte_placement->update(['montant' =>($compte_placement->montant - abs($placement->montant_restant)) ]);
                $placement->delete();

            }else{
                 throw new Exception("Error parceQue vous n'avez pas le montant sur votre compte");
            }
            DB::commit();
            
        } catch (\Exception $e) {

            DB::rollback();
            return back();
             errorMessage($e->getMessage());
            // dump($e->getMessage())
        }

        return back();


    }
}

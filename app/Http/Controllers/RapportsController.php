<?php

namespace App\Http\Controllers;

use App\Models\ComptePrincipalOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Operation;

class RapportsController extends Controller
{
	public function index()
	{

		// $a = <<<EOL
		// <h1>Rapport style wainting</h1>
		// Renvoie des rapport quotidienne
		// Renvoie des rapport Mensuelle
		// Renvoie des rapport hebdomadaire
		//    jjdj 

		// EOL;
		return view('rapports.index');
	}

    public function userOperation(){

        return view('rapports.userOperation');

    }

	public function rapport(){

		$searchDate = \Request::get('date_rapport');

		// $result = ComptePrincipalOperation::where('created_at','LIKE',$request.'%')->sum('depense');

		// `retrait`, `versement`, `placement`, `decouvert`, `reboursement`, `tenue_compte`, `annulation_versement`, `annulation_retrait`, `paiment_placement`, `depense`


		$data = DB::table('compte_principal_operations')
				->where('created_at','LIKE',$searchDate.'%')
                ->select(
                	// DB::raw('SUM(retrait) as total_retrait'),
                	// DB::raw('SUM(versement) as total_versement'),
                	DB::raw('SUM(depense) as total_depense'),
                	DB::raw('SUM(placement) as total_placement'),
                	DB::raw('SUM(reboursement) as total_reboursement'),
                	DB::raw('SUM(decouvert) as total_decouvert'),
                	DB::raw('SUM(annulation_retrait) as total_annulation_retrait'),
                    DB::raw('SUM(annulation_versement) as total_annulation_versement'),
                	DB::raw('SUM(paiment_placement) as total_paiment_placement'),
                	DB::raw('created_at'),
                )
                ->where('deleted_at','=',NULL)
                ->get();

        $versement = Operation::where('type_operation','=','VERSEMENT')
        						->where('created_at','LIKE',$searchDate.'%')
        						->sum('montant');

        $retrait = Operation::where('type_operation','=','RETRAIT')
        						->where('created_at','LIKE',$searchDate.'%')
        						->sum('montant');						
       //	$retrait = Operation::where('type_operation','=','RETRAIT')->sum('montant');

        // $data['operation'] = DB::table('compte_principal_operations')


      // $data['total_versement'] = $versement;
      // $data['total_retrait'] = $retrait;


        return response()->json([
        	'rapport' => $data,
        	
        	'operation' => [
        		'total_versement' => $versement,
        		'total_retrait' => $retrait

            ]

        		 ]);


	}
	
}
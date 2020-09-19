<?php

namespace App\Http\Controllers;

use App\Models\ComptePrincipalOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

	public function rapport(){

		$searchDate = \Request::get('date_rapport');

		// $result = ComptePrincipalOperation::where('created_at','LIKE',$request.'%')->sum('depense');


		$data = DB::table('compte_principal_operations')
				->where('created_at','LIKE',$searchDate.'%')
                ->select(
                	DB::raw('SUM(retrait) as total_retrait'),
                    DB::raw('SUM(depense) as total_depense'),
                	DB::raw('SUM(versement) as total_versement'),
                	DB::raw('SUM(depense) as total_depense'),
                	DB::raw('SUM(placement) as total_placement'),
                	DB::raw('SUM(reboursement) as total_reboursement'),
                	DB::raw('SUM(depense) as depense'),
                	DB::raw('SUM(decouvert) as decouvert'),
                	DB::raw('created_at'),
                )
                ->get();


        return response()->json(['rapport' => $data ]);


	}
	
}
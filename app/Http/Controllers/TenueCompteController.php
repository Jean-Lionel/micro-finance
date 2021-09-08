<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\TenueCompte;
use Illuminate\Http\Request;

class TenueCompteController extends Controller
{


    //paiment d'une seule compte return True si tout est passe est 
    //Le nom si pas reussi 

	public function index(){

		$compte_all = Compte::all();

		$result = TenueCompte::allAccountPaiment($compte_all);

		$result = TenueCompte::montantMensuelle();

		return $result;
	}

    //LA function retourner le montant mensuelle de tout les employes et retourner les comptes de le montant est indufisant

	public function tenueMensuelle(){

		$compte_all = Compte::all();

		$compteError = TenueCompte::allAccountPaiment($compte_all);

		$montantTotal = TenueCompte::montantMensuelle();

		// $test = TenueCompte::tenueMensuelPaye('COO-2');

		// $clients = function ($compteError){
		// 	$c = [];
		// 	foreach ($compteError as $value) {
		// 		$c[] = $value->client;
		// 	}
		// 	return $c;
		// };

		// return response()->json(

		// 	[
		// 		'compte_error' => $compteError, 
		// 		'client' => $clients($compteError),
		// 		'montant_total_mensuel'=>$montantTotal 

		// 	]
		// );
		// 
		

		$data =  [
			'compte_error' => $compteError, 
			// 'client' => $clients($compteError),
			'montant_total_mensuel'=>$montantTotal 

		];

		
		return view('rapports.unpaid',
			[
				'compte_error' => $compteError, 
				'montant_total_mensuel'=>$montantTotal 
			]

		);

	}



}



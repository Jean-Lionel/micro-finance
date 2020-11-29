<?php

namespace App\Models;

use App\Models\Compte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class PaiementPlacement extends Model
{
	public $fillable = ['compte_name',
	'placement_id',
	'montant',
	'montant_restant'];

	//La function prends tout les placements disponible dont la date de fin superieur a current date

	public static function paimentMensuellePlacement($placements){
		
		foreach ($placements as $placement) {
			$startDate = Carbon::create($placement->date_placement);
			$endDate = Carbon::create($placement->date_fin);
			$check = Carbon::now()->between( $startDate,$endDate);

			if($check){
				// Object Placement
				// Trouver le compte correspondant 
				// AJouter le montant sur son compte
				// Enregistre l'operation sur la table de paimentPlacement
				// Ne pas ajouter la somme si l'operation est deja effectuer Au cour de ce moi
				//dump($placement);

				if(!self::payePlacementPaye($placement->id)){
					// On ajouter la somme si est seulement si le montant n'est pas payer

					$compte_name = $placement->compte_name;

					$compte = Compte::where('name','=',$compte_name)->first();

					if($compte != null){
					//Enregistre l'operation dans Paiment Placement

						self::create([
							'compte_name' => $compte_name,
							'placement_id' => $placement->id,
							'montant' => $placement->interet_Moi,
							'montant_restant' => 0,
						]);
					//Ajout du montant sur le compte parant

						$compte->update([
							'montant' => ($compte->montant + $placement->interet_Moi)
						]);

					}

				}

			}
		}

	}


	public static function payePlacementPaye($placement_id)
	{
		$current_month = date('Y').'-'. date('m');

		$response = self::where('placement_id','=',$placement_id)
		-> where('created_at','LIKE',$current_month.'%')
		->first();
		return $response ? true : false;

	}
}

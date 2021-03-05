<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Compte;
use App\Models\ComptePlacement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Placement extends ParentModel
{

	protected $fillable = [
	'montant','compte_name',
	'nbre_moi','interet_total',
	'interet_Moi','place_interet',
	'date_placement','user_id','date_fin','status',
	'interet','montant_restant'
	];

	public $sortable = [
	'montant','compte_name',
	'nbre_moi','interet_total',
	'interet_Moi','place_interet',
	'date_placement','user_id','date_fin','status',
	'created_at'
	];

	public static function boot(){
		parent::boot();

		self::creating(function($model){
			$model->user_id = Auth::user()->id;
			});
	}

	public function getClientNameAttribute(){

		$compte = ComptePlacement::where('name','=', $this->compte_name)->first();

		return $compte->client->fullName ?? "";
	}

}

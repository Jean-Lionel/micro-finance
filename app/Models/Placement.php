<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Placement extends ParentModel
{

	protected $fillable = [
	'montant','compte_name',
	'nbre_moi','interet_total',
	'interet_Moi','place_interet',
	'date_placement','user_id','date_fin','status'
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

}

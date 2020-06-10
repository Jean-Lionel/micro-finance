<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Placement extends ParentModel
{

	protected $fillable = [
	'montant','compte_name',
	'nbre_moi','interet_total',
	'interet_Moi','place_interet',
	'date_placement'
	];

	public $sortable = [
	'montant','compte_name',
	'nbre_moi','interet_total',
	'interet_Moi','place_interet',
	'date_placement'
	];


}

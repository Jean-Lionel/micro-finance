<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class ComptePrincipalOperation extends ParentModel
{

	// annulation_versement`, `annulation_retrait

	use SoftDeletes;

	protected $fillable = [
	'retrait','versement','compte_name','placement','decouvert','depense','reboursement','tenue_compte','annulation_versement','annulation_retrait','paiment_placement','moins','suppression_placement'];
	
	//annulation_versement
        //annulation_versement


	public static function boot(){

		parent::boot();
		
		self::creating(function($model){

			$model->user_id = Auth::user()->id;
			$model->agence_id = Auth::user()->agence_id;

			// dd($model);
		});
	}
}

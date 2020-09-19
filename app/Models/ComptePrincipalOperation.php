<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ComptePrincipalOperation extends Model
{

	protected $fillable = [
	'retrait','versement','compte_name','placement','decouvert','depense','reboursement','tenue_compte'];


	public static function boot(){

		parent::boot();
		
		self::creating(function($model){

			$model->user_id = Auth::user()->id;
		});
	}
}

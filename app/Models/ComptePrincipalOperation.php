<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ComptePrincipalOperation extends Model
{

	protected $fillable = [
	'retrait','versement','placement','decouvert'];


	public static function boot(){

		parent::boot();


		self::creating(function($model){

			$model->user_id = Auth::user()->id;
		});
	}
}

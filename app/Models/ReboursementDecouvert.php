<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ReboursementDecouvert extends ParentModel
{
	protected $fillable = ['compte_name',
							'montant',
							'date_remboursement',
							'decouvert_id'
						  ];



	protected $sortable = [
							'compte_name',
							'montant',
							'date_remboursement',
							'decouvert_id'
						  ];


	public function decouverts(){
		return $this->hasMany('App\Models\Decouvert');
	}
	
	public static function boot(){
		parent::boot();

		self::creating(function($model){
			$model->user_id = Auth::user()->id;
			});
	}

	public function decouvert(){
		return $this->belongsTo('App\Models\Decouvert');
	}


}

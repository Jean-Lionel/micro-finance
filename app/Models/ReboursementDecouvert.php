<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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


}

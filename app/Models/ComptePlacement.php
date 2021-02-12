<?php

namespace App\Models;


use App\Models\ParentModel;
use Illuminate\Database\Eloquent\Model;

class ComptePlacement extends ParentModel
{
    //

	protected $fillable = ['name',
	'montant','placement_client_id'];

	 public function client()
    {
        return $this->belongsTo('App\Models\PlacementClient','placement_client_id','id');
    }
}

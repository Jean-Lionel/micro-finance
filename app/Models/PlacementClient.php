<?php

namespace App\Models;


use App\Models\ComptePlacement;
use App\Models\ParentModel;
use Illuminate\Database\Eloquent\Model;

class PlacementClient extends ParentModel
{

	




	protected $fillable = ['nom', 'prenom','cni','telephone','addresse', 'mandataire_name' ,'mandataire_telephone','mandataire_cni','mandataire_addresse'];



	public function compte()
    {
        return $this->hasOne('App\Models\PlacementClient');
    }

	public function getCompteNameById($object){
		$comptePlacement = ComptePlacement::where('placement_client_id',$object->id ?? $object)->first();


		return $comptePlacement->name ?? "";

	}

}

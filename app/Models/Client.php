<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends ParentModel
{
    
    protected $fillable = [
    'nom',
    'prenom',
    'antenne',
    'cni',
    'date_naissance',
    'date_ouverture',
    'nom_association',
    'nom_mandataire_1',
    'nom_mandataire_2',
    'nationalite',
    'date_delivrance',
    'etat_civil',
    'nom_conjoint',
    'profession',
    'nom_employeur',
    'lieu_activite',
    'commune',
    'quartier',
    'rue',
    'address_no',
    'boite_postal',
    'telephone',
    'signateur_1_nom_prenom',
    'signateur_1_cni',
    'signateur_1_tel',
    'signateur_2_nom_prenom',
    'signateur_2_cni',
    'signateur_2_tel',
    'signateur_3_nom_prenom',
    'signateur_3_cni',
    'signateur_3_tel',
    'image'
    ];
    
    public $sortable = ['nom','prenom','cni','date_naissance','created_at','antenne'];


    public function comptes()
    {
        return $this->hasMany('App\Models\Compte');
    }
}

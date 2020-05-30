<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends ParentModel
{
    
    protected $fillable = ['nom','prenom','cni','date_naissance'];
    
    public $sortable = ['nom','prenom','cni','date_naissance'];


     public function comptes()
    {
        return $this->hasMany('App\Models\Compte');
    }
}

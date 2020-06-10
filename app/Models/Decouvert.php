<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Decouvert extends ParentModel
{
    //

    protected $fillable = ['compte_name','montant','interet','total_a_rambourse','periode'];
    public $sortable = ['compte_name','montant','interet','total_a_rambourse','created_at','periode'];
    

}

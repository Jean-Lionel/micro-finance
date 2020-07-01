<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Depense extends ParentModel
{
    //



    protected $fillable = ['action_name','montant'];
    public $sortable = ['action_name','montant'];




}

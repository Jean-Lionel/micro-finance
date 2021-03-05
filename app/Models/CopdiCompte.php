<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CopdiCompte extends ParentModel
{
    protected $fillable = ['name','montant'];
    public $sortable = ['name','montant','created_at'];
}

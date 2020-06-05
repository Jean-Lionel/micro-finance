<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends ParentModel
{
    //

    protected $fillable = ['compte_id','montant','type_operation'];

    public $sortable = ['compte_id','montant','type_operation'];


}

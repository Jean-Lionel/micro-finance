<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation extends ParentModel
{
    //

    protected $fillable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni'
    ];

    public $sortable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni'
    ];



}

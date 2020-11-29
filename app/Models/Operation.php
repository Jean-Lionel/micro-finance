<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Operation extends ParentModel
{
    //

    protected $fillable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni'
    ];

    public $sortable = ['compte_name','operer_par','montant','type_operation',
    'user_id','cni','created_at'
    ];

    public static function boot()
    {
    	parent::boot();

    	self::creating(function($model){

            $model->user_id = Auth::user()->id;

            $model->montant = abs($model->montant);


            });

    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


}
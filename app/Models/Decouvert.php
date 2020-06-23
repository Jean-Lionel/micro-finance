<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Decouvert extends ParentModel
{
    //

    protected $fillable = [
    'compte_name','montant','interet','total_a_rambourse','periode',
    'montant_payer',
	'montant_restant'
    ];
    public $sortable = [
    'compte_name','montant','interet','total_a_rambourse',
    'created_at','periode',
    'montant_payer',
	'montant_restant'];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
                $model->user_id = Auth::user()->id;
            });
    }


}

<?php

namespace App\Models;

use App\Models\Compte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Decouvert extends ParentModel
{
    //

    protected $fillable = [
    'compte_name','montant','interet','total_a_rambourse','periode',
    'montant_payer','paye',
	'montant_restant','date_fin'
    ];
    public $sortable = [
    'compte_name','montant','interet','total_a_rambourse',
    'created_at','periode',
    'montant_payer',
	'montant_restant','date_fin',
    'paye'];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
                $model->user_id = Auth::user()->id;
            });
    }


    public function getClientNameAttribute(){

        $compte = Compte::where('name','=', $this->compte_name)->first();
    
        return $compte->client->fullName ?? "";
    }

    public function client(){

        $compte = Compte::where('name','=', $this->compte_name)->first();
    
        return $compte->client;
    }


}

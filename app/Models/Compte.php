<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends ParentModel
{
    //

    protected $fillable = ['client_id','montant','name','type_compte'];

    public $sortable = ['client_id','montant','name','type_compte'];

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public static function getCompteByName($name){
    	return self::where('name','=', $name)->first();
    }
}

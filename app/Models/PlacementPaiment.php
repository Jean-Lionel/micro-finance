<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PlacementPaiment extends ParentModel
{
    //

    protected $fillable = ['montant','date_paiment','compte_name','compte_placement_id','client_id','user_id'];


    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    	});
    }

    public function compte(){
    	return $this->belongsTo('App\Models\ComptePlacement','compte_placement_id');
    }




}

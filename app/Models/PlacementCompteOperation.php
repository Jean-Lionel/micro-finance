<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PlacementCompteOperation extends Model
{
    //

    use SoftDeletes;

    protected $fillable = ['type_operation','compte_name','montant','user_id','placement'];

    public static function boot(){

		parent::boot();
		
		self::creating(function($model){

			$model->user_id = Auth::user()->id;

			// dd($model);
		});
	}
}

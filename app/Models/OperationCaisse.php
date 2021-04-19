<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class OperationCaisse extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];


    public static function boot(){
    	parent::boot();
    	
    	self::creating(function($model){
    		$model->admin_id = Auth::user()->id;

    	});

    }
}

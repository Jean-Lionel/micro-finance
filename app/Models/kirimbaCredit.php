<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class kirimbaCredit extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    	});
    }

    public function operation(){
    	return $this->belongsTo(KirimbaOperation::class, 'operation_id','id');
    }
}

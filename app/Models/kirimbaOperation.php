<?php

namespace App\Models;

use App\Models\KirimbaCompte;
use App\Models\kirimbaCredit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class kirimbaOperation extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;
    	});
    }

    public function compte(){
    	return $this->belongsTo(KirimbaCompte::class,'kirimba_compte_id','id');
    }

    public function credit(){
        return $this->belongsTo(kirimbaCredit::class,'id','operation_id');
    }

   
}

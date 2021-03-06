<?php

namespace App\Models;

use App\Models\KirimbaCompte;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KirimbaMembre extends Model
{
    //
    use SoftDeletes;
    
    protected $guarded = [];

    public function compte(){
    	return $this->belongsTo(KirimbaCompte::class,'id', 'kirimba_membre_id');
    }

    public static function boot(){
    	parent::boot();

    	self::creating(function($model){
    		$model->user_id = Auth::user()->id;

    	});
    }

    public function getFullNameAttribute(){
        return $this->first_name .' '.$this->last_name;
    }
}

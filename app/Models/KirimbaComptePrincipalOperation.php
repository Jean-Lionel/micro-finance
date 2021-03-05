<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KirimbaComptePrincipalOperation extends Model
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

    public static function isValideRegistration(){
        $latestDate = self::latest()->first() ?? new KirimbaComptePrincipalOperation;

        if(Carbon::now() <  $latestDate->created_at ){
            throw new \Exception("Verifier que la date est bien regler . date(Y-m-d)", 1);
            return false;
        }


    	return true;
    }
}

<?php

namespace App\Models;

use App\Models\OperationCaisse;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class CaisseCaissier extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    public function user(){
    	return $this->belongsTo(User::class,'user_id','id');
    }

    public function operations(){
        return $this->hasMany(OperationCaisse::class , 'user_id' ,'id');
    }

    public function todayVirement(){

        $operations = OperationCaisse::where('user_id', $this->user_id)->whereDate('created_at', Carbon::now())->get();

        return $operations;
    }
}

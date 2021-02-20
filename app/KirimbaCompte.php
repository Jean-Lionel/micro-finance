<?php

namespace App;

use App\KirimbaMembre;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KirimbaCompte extends Model
{
    //
    use SoftDeletes;

    protected $guarded = [];

    public function membre(){
    	return $this->belongsTo(KirimbaMembre::class , 'kirimba_membre_id','id');
    }
}

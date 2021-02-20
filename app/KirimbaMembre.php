<?php

namespace App;

use App\KirimbaCompte;
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
}

<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchUpdateDecouvert extends Model
{
    use HasFactory;
    protected $guarded = [];

    /*public static function boot(){

        self::creating(function($model){
            $model->user_id = auth()->user()->id;
        });
    }*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getFullDescritionAttribute(){
        return collect(json_decode($this->description));
    }
}

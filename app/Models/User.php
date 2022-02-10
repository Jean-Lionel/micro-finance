<?php

namespace App\Models;

use App\Models\Agence;
use App\Models\CaisseCaissier;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','user_name','last_name' ,'email', 'password','agence_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function caisse(){
        return $this->belongsTo(CaisseCaissier::class,'id','user_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name .' '. $this->last_name;
    }
    public function agence(){
        return $this->belongsTo(Agence::class,'agence_id','id');
    }

    // public function getIdAttribute(){
    //     return $this->id;
    // }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function isAdmin()
    {
        return $this->roles()->where('name','ADMIN')->first() || $this->id == 1;
    }

    public function hasAnyRoles(array $roles)
    {
        return $this->roles()->whereIn('name',$roles)->first();
    }

    public function isRetraitUser()
    {
        return $this->roles()->where('name','RETRAIT')->first();
    }

    public function isVersementUser(){
        return $this->roles()->where('name','VERSEMENT')->first();
    }

    public function isRegisterClient(){
         return $this->roles()->where('name','ENREGISTREMENT DES CLIENTS')->first();
    }

    public function isRetraitInteretPlacement()
    {
        return $this->roles()->where('name','PAIEMENT DES INTERET SUR LES PLACEMENT')->first();
    }

    public function isDecouvert()
    {
        return $this->roles()->where('name', 'GESTION DES DECOUVERTS')->first();
    } 
    public function isPlacement()
    {
        return $this->roles()->where('name', 'GESTION DES PLACEMENTS')->first();
    }

    // DROIT POUR KWIZERA CHANTAL AOUT 2021

    public function isDeleteDecouvert(){
        /*return $this->first_name == "KWIZERA" && $this->last_name == "Chantal" && $this->id == 3; */
        return false;
    }

    // DROIT POUR JEAN LIONEL AOUT 2021

    public function superAdmin(){
        return $this->id === 1 && $this->last_name =="Nininahazwe";
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenueCompte extends Model
{
 protected $fillable = ['compte_name','montant'];

 public function compte(){

    return $this->belongsTo('App\Models\Compte');
}


    // Paiment de tout les compte
    // Retourne True si tout a passe 
    // est la liste des compte dont la somme est inferieur au tenu du compte

public static function  uniquePaid($compte_name){

    $compte = Compte::where('name', '=', $compte_name)->firstOrFail();

    if($compte->montant >=TENU_COMPTE_MENSUELLE){

        $compte->update([
            'montant' => ($compte->montant - TENU_COMPTE_MENSUELLE)
        ]);


        self::create([

            'compte_name' => $compte_name,
            'montant' => TENU_COMPTE_MENSUELLE,
        ]);

    }else{
       return $compte;
   }

   return 'SUCCESS';
}

//Paiement de tout les comptes 
//et le retour des comptes qui ne peut paye

public static function allAccountPaiment($all_account, $date_paiement = ""){

    $error_account = [];

    foreach ($all_account as $compte) {

        //$error_account[] = self::tenueMensuelPaye($compte->name);

        if(!self::tenueMensuelPaye($compte->name)){

            $response = self::uniquePaid($compte->name);

            if($response != 'SUCCESS')
                $error_account[] = $response;
        }
    }

    return $error_account;

}

public static function montantMensuelle($date_d = null)
{
    $date_search = $date_d ?? date('Y').'-'.date('m');

    $sum = self::where('created_at','LIKE',$date_search.'%')->sum('montant');

    return $sum;
}

public static function tenueMensuelPaye($compte_name,$date_paiement = null){

    $date_search = $date_paiement ?? date('Y').'-'.date('m');

    //dd($date_search);

     $result = self::where('compte_name','=',$compte_name)
                    ->where('created_at', 'LIKE', $date_search.'%' )->get();


    return  $result->count() >0 ? true : false;
}


}

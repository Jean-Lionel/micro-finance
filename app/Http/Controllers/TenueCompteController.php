<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\TenueCompte;
use Illuminate\Http\Request;

class TenueCompteController extends Controller
{


    //paiment d'une seule compte return True si tout est passe est 
    //Le nom si pas reussi 

    public function index(){

        $compte_all = Compte::all();

        $result = TenueCompte::allAccountPaiment($compte_all);

        $result = TenueCompte::montantMensuelle();

        return $result;
    }


}

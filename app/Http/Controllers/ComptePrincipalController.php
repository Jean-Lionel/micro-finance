<?php

namespace App\Http\Controllers;

use App\Models\ComptePrincipal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ComptePrincipalController extends Controller
{

    public static function currentValue(){
        return ComptePrincipal::latest()->firstOrFail()->montant;
    }


    public static function update($motant, $type_Operation){

        //I get the last value of compte bank

        $errors = '';

        $comptePrincipal = ComptePrincipal::latest()->first();


        if(!$comptePrincipal){
            ComptePrincipal::create(['montant' => 0]);
            $comptePrincipal = ComptePrincipal::latest()->first();
        }

        $currentValue = $comptePrincipal->montant;
        $newValue = $currentValue;


        switch($type_Operation){

            case 'RETRAIT':
                $newValue = oparate($currentValue,$motant,'MOINS');
                break;

            case 'VERSEMENT':
                $newValue = oparate($currentValue,$motant,'ADD');
                break;

            case 'PLACEMENT':
                $newValue = oparate($currentValue,$motant,'ADD');
                break;

            case 'DECOUVERT':
                $newValue = oparate($currentValue,$motant,'MOINS');
                break;
                
            case 'REMBOURSEMENT':
                $newValue = oparate($currentValue,$motant,'ADD');
                break;

            default:
                return false;

        }

        if($newValue){

            //On test si c'est la meme journe 
            //On fait tout simplement la modification
            //Une nouvelle journe on fait la creation

            $dateOfLastActivity = new Carbon($comptePrincipal->created_at);

            if($dateOfLastActivity->isCurrentDay()){
                $comptePrincipal->update(['montant' => $newValue]);
            }else{

                $today = new Carbon();

                if($today < $dateOfLastActivity){
                    
                    return 'Votre date n\'est pas bien regle';
                }else{
                    ComptePrincipal::create(['montant' => $newValue]);

                    return 'OK';
                }
            }
             return 'OK';

         }else{
            
            return "Le montant sur le compte principale est insuffisant";
         }
    }

   
}


 function oparate($last_montant , $newMontat, $type_Operation){
        if($type_Operation == 'ADD')
            return $last_montant + $newMontat;
        else if($type_Operation == 'MOINS')
            return $last_montant > $newMontat ? ($last_montant - $newMontat) : false;
    }
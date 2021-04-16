<?php

namespace App\Http\Controllers;

use App\Models\ComptePrincipal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Exception;

class ComptePrincipalController extends Controller
{

    public static function currentValue(){
        return ComptePrincipal::latest()->firstOrFail()->montant;
    }


    // public static function update($motant, $type_Operation){

    //     //I get the last value of compte bank

    //     $type_Operation = mb_strtoupper($type_Operation);

    //     $errors = '';

    //     $comptePrincipal = ComptePrincipal::latest()->first();


    //     if(!$comptePrincipal){
    //         ComptePrincipal::create(['montant' => 0]);
    //         $comptePrincipal = ComptePrincipal::latest()->first();
    //     }

    //     $currentValue = $comptePrincipal->montant;
    //     $newValue = $currentValue;


    //     switch($type_Operation){

    //         case 'RETRAIT':
    //             $newValue = oparate($currentValue,$motant,'MOINS');
    //             break;

    //         case 'VERSEMENT':
    //             $newValue = oparate($currentValue,$motant,'ADD');
    //             break;

    //         case 'PLACEMENT':
    //             $newValue = oparate($currentValue,$motant,'ADD');
    //             break;

    //         case 'DECOUVERT':
    //             $newValue = oparate($currentValue,$motant,'MOINS');
    //             break;
                
    //         case 'REMBOURSEMENT':
    //             $newValue = oparate($currentValue,$motant,'ADD');
    //             break;

    //         case 'DEPENSE':
    //             $newValue = oparate($currentValue,$motant,'MOINS');
    //             break;
    //         case 'ADD':
    //             $newValue = oparate($currentValue,$motant,'ADD');
    //             break;
    //         case 'MOINS':
    //             $newValue = oparate($currentValue,$motant,'MOINS');
    //             break;

    //         default:
    //             return false;

    //     }

    //     if($newValue){

    //         //On test si c'est la meme journe 
    //         //On fait tout simplement la modification
    //         //Une nouvelle journe on fait la creation

    //         $dateOfLastActivity = new Carbon($comptePrincipal->created_at);

    //         if($dateOfLastActivity->isCurrentDay()){
    //             $comptePrincipal->update(['montant' => $newValue]);

    //             return "OK";
    //         }else{

    //             $today = new Carbon();

    //             if($today < $dateOfLastActivity){
                    
    //                 return 'Votre date n\'est pas bien regle';
    //             }else{
    //                 ComptePrincipal::create(['montant' => $newValue]);

    //                 return 'OK';
    //             }
    //         }
    //          // return 'OK';

    //      }else{
            
    //         return "Le montant sur le compte principale est insuffisant";
    //      }
    // }





    public static function check_update_is_valide($motant, $type_Operation)
    {

        $type_Operation = mb_strtoupper($type_Operation);

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

            case 'DEPENSE':
                $newValue = oparate($currentValue,$motant,'MOINS');
                break;
            case 'ADD':
                $newValue = oparate($currentValue,$motant,'ADD');
                break;
            case 'MOINS':
                $newValue = oparate($currentValue,$motant,'MOINS');
                break;

            default:
                return "Actitvité non permise";

        }

        if($newValue){

            //On test si c'est la meme journe 
            //On fait tout simplement la modification
            //Une nouvelle journe on fait la creation

            $dateOfLastActivity = new Carbon($comptePrincipal->created_at);

            if($dateOfLastActivity->isCurrentDay()){

                // $comptePrincipal->update(['montant' => $newValue]);

                //Today signifie qu'au renvoi le meme jour donc on fait la modification

                return ["day"=> "TODAY", 'value' => $newValue];

            }else{

                $today = new Carbon();

                if($today < $dateOfLastActivity){
                    
                    return 'Votre date n\'est pas bien regle';
                }else{
                    // ComptePrincipal::create(['montant' => $newValue]);
                    // Pour dire le dernier jour passse

                    return ["day"=> "YESTARDAY", 'value' => $newValue];;
                }
            }
             // return 'OK';
         }else{
            
            return "Le montant sur le compte principale est insuffisant";
         }
    }

    //2h pour ecrire cette fonction
    //le 19/09/2020

    public static function store_info($motant, $type_Operation)
    {

        $response = self::check_update_is_valide($motant, $type_Operation);
        //dd($response); MOIS MOINS 
        if(is_array($response))
        {
            if($response['day'] == 'TODAY'){
                $comptePrincipal = ComptePrincipal::latest()->first();

              $comptePrincipal->update(['montant' => $response['value']]);
            }

            if($response['day'] == 'YESTARDAY'){
                ComptePrincipal::create(['montant' => $response['value']]);
            }



        }else{

             //return $response;
          throw new \Exception($response);
        }

        //  return $response;
        
    }

   
}


 function oparate($last_montant , $newMontat, $type_Operation){
        if($type_Operation == 'ADD')
            return $last_montant + $newMontat;
        else if($type_Operation == 'MOINS')
            return $last_montant > $newMontat ? ($last_montant - $newMontat) : false;
    }
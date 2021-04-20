<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\AgenceOperation;
use App\Models\CaisseCaissier;
use App\Models\ComptePrincipal;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

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

        //JE VEUX AUTORISE L'OPERATION SUR 2 AGENCE KINAMA ET RUBIRIZI
        // CODE IRAGANJE 

        if(Auth::user()->agence_id < 3){
             $agence = Agence::find(Auth::user()->agence_id);
        }else{
            throw new Exception("Vous n'appartiez à aucune agence !!! 🤣😂🤣😁👍🎂🎂 ", 1);
        }
        
       // $agence = Agence::find(Auth::user()->agence_id);

        if(! $agence){
            throw new Exception("Vous n'appartiez à aucune agence ", 1);
        }
        $caisse_caissier = CaisseCaissier::where("user_id",Auth::user()->id)->first();
       // dd($caisse_caissier);
        if(! $caisse_caissier){
            throw new Exception("Vous n'avez pas  à aucune caisse ", 1);
        }

        if($type_Operation == 'ADD'){
            //ON CHERCHER L'AGANCE 
            $caisse_caissier->montant += $newMontat;
            $caisse_caissier->save();
            //dd($agence);
            return $last_montant + $newMontat;
        }
        else if($type_Operation == 'MOINS'){
            // ON CHERCHER ON FAIT LA SOUSTRACTION
            if( $caisse_caissier->montant < $newMontat){
                //MUGIHE ATA MAFARANGA ARIKO KURI IYO AGENCE
                 throw new Exception("Votre Caisse ne possède pas cet montant demandé", 1);
            }else{
                 $caisse_caissier->montant -= $newMontat;
                 $caisse_caissier->save();
            }
            return $last_montant > $newMontat ? ($last_montant - $newMontat) : false;
        }
}
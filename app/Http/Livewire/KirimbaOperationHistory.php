<?php

namespace App\Http\Livewire;

use App\Models\KirimbaComptePrincipal;
use App\Models\KirimbaComptePrincipalOperation;
use App\Models\kirimbaOperation as KOperation;
use Livewire\Component;

class KirimbaOperationHistory extends Component
{
	public $compte_name = "K-";


    public function render()
    {
    	$c = $this->compte_name;

    	$operations = KOperation::latest()->where(
    		function($query) use($c){
    			if($c != 'K-' or $c== ''){
    				$query->where('compte_name', '=',$c );
    			}
    		}

    	 )->paginate();

        return view('livewire.kirimba-operation-history',[
        	'operations' => $operations
        ]);
    }

    public function updateOperation($id)
    {
    	$operation = KOperation::find($id);
    }

    public function deleteOperation($id){
    	try {
    		$operation = KOperation::find($id);


    		// dump($operation);
    		
    		if( KirimbaComptePrincipalOperation::isValideRegistration() == false){
                throw new \Exception("Votre date n'est pas bien réglé", 1);
            }
              $compte_principal = KirimbaComptePrincipal::latest()->first() ?? new KirimbaComptePrincipal;
              $compte = $operation->compte;

            if($operation->type_operation == 'RETRAIT'){

            	//AJOUT DU MONTANT SUR LE COMPTE DU MEMBRE
            	$compte->montant += $operation->montant;
            	//AJOUT DU MONTANT SUR LE COMPTE PRINCIPAL
            	$compte_principal->montant += $operation->montant;

            	//ENREGISTREMENT DE L'OPERATION SUR LE COMPTE PRINCIPAL

            	KirimbaComptePrincipalOperation::create([
	                'operation_type' => "ANNULATION DU RETRAIT",
	                'montant' => $operation->montant,
	                'compte_name' => $operation->compte_name
            	]);

            	$compte->save();
            	$compte_principal->save();

            	// dd($operation->credit);

            	if($operation->credit){
            		//SI L'OPERATION A UN CREDIT ON SUPPRIMER AUSSI CA
            		$operation->credit->delete();
            	}
            	//SUPPRESSION DE L'OPERATION
            	$operation->delete();

    		}

    		if($operation->type_operation == "VERSEMENT"){

    			//DIMINUER LE MONTANT DU COMPTE PRINCIPALE
    			//DIMINUER LE MONTANT DU MEMBRE 
    			//ENREGISTRE
            	$compte->montant -= $operation->montant;
            	$compte_principal->montant -= $operation->montant;

            	$compte->save();
            	$compte_principal->save();
            	
            	KirimbaComptePrincipalOperation::create([
		                'operation_type' => "ANNULATION DU VERSEMENT",
		                'montant' => $operation->montant,
		                'compte_name' => $operation->compte_name
           			]);

            	$operation->delete();

    			// dd($operation);

    		}

    		//dd(	"REUSSI" );

    		
    	} catch (\Exception $e) {
    		dd($e->getMessage());
    		
    	}
    }
}

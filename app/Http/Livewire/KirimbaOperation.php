<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\KirimbaCompte;
use App\Models\kirimbaOperation as KOperation;
use Illuminate\Support\Facades\DB;
use App\Models\KirimbaComptePrincipal;
use App\Models\KirimbaComptePrincipalOperation;


class KirimbaOperation extends Component
{
	public $kirimba_compte_id;
	public $CompteName ="K-";
	public $type_operation;
	public $montant;
	public $membre = null;


	protected $rules = [
		'montant' => 'required|min:0|numeric',
		'CompteName' => 'required|exists:kirimba_comptes,name',
		'type_operation' => 'required|in:RETRAIT,VERSEMENT',
	];

    public function render()
    {
        return view('livewire.kirimba-operation');
    }

    public function saveOperation(){
    	
        $this->validate($this->rules);

        /**
         * VERFIER LE MONTANT SUR LE COMPTE PRINCIPAL IKIRIMBA
         * VERFIER QU'IL Y A LE MONTANT SUR LE COMPTE DU MEMBRE
         *
         * ENLEVE LE MONTANT SUR LE COMPTE DU MEMBRE
         *
         * ENLEVE LE MONTANT SUR LE COMPTE PRINCIPAL
         *
         * 
         */
        
        try {
            DB::beginTransaction();

            if( KirimbaComptePrincipalOperation::isValideRegistration() == false){
                throw new \Exception("Votre date n'est pas bien réglé", 1);
            }

            $compte_principal = KirimbaComptePrincipal::latest()->first() ?? new KirimbaComptePrincipal;
             $compte = $this->membre->compte;

            if($this->type_operation == 'RETRAIT')
            {
                if($this->montant > $compte_principal->montant){
                    //ERROR
                    throw new \Exception("Le compte principal de IKIRIMBA ne possede pas cette montant demande", 1);
                    
                }else{
                    //ON CHERCHE LE COMPTE DU MEMBRE 
                    //
                    //UN MEMBRE A LE DROIT DE DEMANDE LE MONTANT < 1/2 de son compte 
                    //principal 
                    
                    if($this->montant < ($this->membre->compte->montant * 2)){
                        //RETRAIT 
                       
                        
                        $compte_principal->montant  -= $this->montant;

                        $compte_principal->save();

                        $compte->montant -= $this->montant;

                        $compte->save();

                    }else{
                        //ERROR 
                        throw new \Exception("Solde insufisant sur votre compte", 1);
                        
                    }
                }

            }else if($this->type_operation == 'VERSEMENT'){

                //AUGMENTER LE MONTANT DU COMPTE PRINCIPALE 
                
                 $compte = $this->membre->compte;   
                 $compte_principal->montant  += $this->montant;
                 $compte_principal->save();
                 $compte->montant += $this->montant;
                 $compte->save();
            }

           $op = KOperation::create([
                'kirimba_compte_id' =>  $compte->id,
                'compte_name' =>  $compte->name,
                'type_operation' =>  $this->type_operation,
                'montant' => $this->montant
            ]);

            KirimbaComptePrincipalOperation::create([

                'operation_type' => $op->type_operation,
                'montant' => $op->montant,
                'compte_name' => $op->compte_name


            ]);

             session()->flash('success', 'Opération réussi.');


            DB::commit();

            $this->reset();
            
        } catch (\Exception $e) {

          
        
             session()->flash('error', $e->getMessage());
            DB::rollback();
            
        }
    }

    public function updatedCompteName(){
    	$compte = KirimbaCompte::where('name','=', $this->CompteName)->first();

    	$this->membre = $compte->membre ?? NULL;

    }
}

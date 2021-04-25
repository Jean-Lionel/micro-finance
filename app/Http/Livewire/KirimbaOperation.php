<?php

namespace App\Http\Livewire;

use App\Models\KirimbaCompte;
use App\Models\KirimbaComptePrincipal;
use App\Models\KirimbaComptePrincipalOperation;
use App\Models\kirimbaCredit;
use App\Models\kirimbaOperation as KOperation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


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
        $user_id = Auth::user()->id;
        $now = date('Y-m-d');
        $opertations = DB::select("select type_operation, SUM(montant) as montant  from `kirimba_operations` where (`user_id` = $user_id and date(`created_at`) = '$now') and `kirimba_operations`.`deleted_at` is null group by `type_operation`");

       // dd($opertations);

        return view('livewire.kirimba-operation',[
            'opertations' =>$opertations
        ]);
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

             $benefice = 0;

            if($this->type_operation == 'RETRAIT')
            {
                if($this->montant > $compte_principal->montant){
                    //ERROR
                    throw new \Exception("Le compte principal de IKIRIMBA ne possede pas cette montant demandé", 1);
                }else{
                    //ON CHERCHE LE COMPTE DU MEMBRE 
                    //
                    //UN MEMBRE A LE DROIT DE DEMANDE LE MONTANT <= 1/2 de son compte 
                    //principal 
                    
                    if($this->montant <= ($this->membre->compte->montant * 2)){
                        //RETRAIT 
                       
                       //SI LE COMPTE EST INFERIEUR AUX MONTANT DU COMPTE

                        // ON DOIT PAYE 2 % DU MONTANT RETIRE 

                        // 200 000 ON PAYE 4000 
                        //DONC C 200 000 x 2 / 100 = 4000 de benefice

                        $compte_principal->montant  -= $this->montant;

                        $compte_principal->save();

                        $compte->montant -= $this->montant;

                        $op = KOperation::create([
                            'kirimba_compte_id' =>  $compte->id,
                            'compte_name' =>  $compte->name,
                            'type_operation' =>  $this->type_operation,
                            'montant' => $this->montant,
                            'benefice' => $benefice
                         ]);

                        if($compte->montant  < 0){
                            //Interet est de 2 % du montant retirer
                            $benefice =  $this->montant * 2 / 100 ;

                            $compte->montant -= $benefice;



                            kirimbaCredit::create([
                                'kirimba_membre_id' => $this->membre->id ,
                                'compte_name' =>$compte->name ,
                                'montant' => $this->montant,
                                'benefice' => $benefice,
                                'operation_id' =>  $op->id
                            ]);
                            
                        }

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

                 $op = KOperation::create([
                'kirimba_compte_id' =>  $compte->id,
                'compte_name' =>  $compte->name,
                'type_operation' =>  $this->type_operation,
                'montant' => $this->montant,
                'benefice' => $benefice
            ]);

            }

           

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

<?php

namespace App\Http\Livewire;

use App\KirimbaCompte;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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

            DB::commit();
            
        } catch (\Exception $e) {
            
        }
    }

    public function updatedCompteName(){
    	$compte = KirimbaCompte::where('name','=', $this->CompteName)->first();

    	$this->membre = $compte->membre ?? NULL;

    }
}

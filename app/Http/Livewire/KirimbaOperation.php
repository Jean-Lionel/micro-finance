<?php

namespace App\Http\Livewire;

use App\KirimbaCompte;
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
		'CompteName' => 'exists:kirimba_comptes,name',
		'type_operation' => 'required|in:RETRAIT,VERSEMENT',
	];

    public function render()
    {
        return view('livewire.kirimba-operation');
    }

    public function saveOperation(){
    	$this->validate($this->rules);
    }

    public function updatedCompteName(){
    	$compte = KirimbaCompte::where('name','=', $this->CompteName)->first();

    	$this->membre = $compte->membre ?? NULL;

    }
}

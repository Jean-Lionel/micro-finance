<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use App\Models\KirimbaCompte;
use App\Models\KirimbaMembre;
use Illuminate\Support\Facades\DB;

class KirimbaMembreLivewire extends Component
{
	use WithPagination;

	public $first_name;
	public $last_name;
	public $cni;
	public $telephone;
	public $identification;
	public $addresse;
	public $search;
	public $showForm = false;

	protected $rules = [
		'first_name' => 'required',
		'last_name' => 'required',
	];

	public function render()
	{
		$searchKey = '%'. $this->search .'%';

		$membres = KirimbaMembre::latest()->where(function($query) use($searchKey){

			$query->where('first_name', 'like', $searchKey)
					->orWhere('last_name', 'like', $searchKey)
					->orWhere('cni', 'like', $searchKey)
					->orWhere('telephone', 'like', $searchKey)
					->orWhere('id', 'like', $searchKey);

		})->paginate();
		return view('livewire.kirimba-membre-livewire',
			['membres' => $membres]

		);
	}

	public function taggleShowForm(){
		$this->showForm = !$this->showForm;
	}


	public function enregistrerMembrer(){
		$this->validate($this->rules);

		try {
			DB::beginTransaction();

			if( $this->identification){
				$membre = KirimbaMembre::find($this->identification);

				$membre->update([
					'first_name' => $this->first_name,
					'last_name' => $this->last_name,
					'telephone' => $this->telephone,
					'cni' => $this->cni,
					'addresse' => $this->addresse,

				]);

			}else{
				$membre = KirimbaMembre::create([
					'first_name' => $this->first_name,
					'last_name' => $this->last_name,
					'telephone' => $this->telephone,
					'cni' => $this->cni,
					'addresse' => $this->addresse,

				]);

				$compte = KirimbaCompte::create([
					'name' => 'K-'.$membre->id ,
					'kirimba_membre_id' => $membre->id,
					'montant' => 0
				]);
			}

			$this->reset();
			$this->identification = null;
			$this->showForm = false;

			DB::commit();
		} catch (\Exception $e) {
			dd($e->getMessage());
			DB::rollback();

		}

	}

	public function modifierMembre($id){
		$membre = KirimbaMembre::find($id);

		$this->first_name = $membre->first_name;
		$this->last_name = $membre->last_name;
		$this->cni = $membre->cni;
		$this->telephone = $membre->telephone;
		$this->addresse = $membre->addresse;

		$this->identification = $membre->id;

		$this->showForm = true;
	}
	public function supprimerMemebre($id){
		KirimbaMembre::find($id)->delete();
	}
}

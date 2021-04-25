<?php

namespace App\Http\Livewire;

use App\Models\ComptePrincipalOperation;
use App\Models\Operation;
use App\Models\ReboursementDecouvert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RapportUser extends Component
{
	public $users = null;
	public $selectedUser = null;
	public $choosedUser = null;
	public $currentDate = null;

	public $operations =null;


	public $versement =null;
	public $retrait =null;

	public $reboursement_decouverts =null;
	public $paiment_placement =null;
	public $kirimbaOperations =[];




	public function mount(){

		$this->users = User::all();
		$this->operations = [];
		$this->currentDate = Carbon::now()->format('Y-m-d');

	}

	public function updatedSelectedUser($user_id){
		$this->choosedUser = User::find($user_id);

		$this->versement = Operation::where('user_id',$user_id)
								->where('type_operation','=','VERSEMENT')
								->whereDate('created_at',$this->currentDate)->sum('montant');

		$this->retrait = Operation::where('user_id',$user_id)
								->where('type_operation','=','RETRAIT')
								->whereDate('created_at',$this->currentDate)->sum('montant');

	   $this->reboursement_decouverts = ReboursementDecouvert::where('user_id', $user_id)
	   														   ->whereDate('created_at',$this->currentDate)->sum('montant');

	   $this->paiment_placement = ComptePrincipalOperation::where('user_id', $user_id)
	   														->whereDate('created_at',$this->currentDate)->sum('paiment_placement');

	   $this->kirimbaOperations =  DB::select("select type_operation, SUM(montant) as montant  from `kirimba_operations` where (`user_id` = $user_id and date(`created_at`) = '$this->currentDate') and `kirimba_operations`.`deleted_at` is null group by `type_operation`");

	}

	public function updatedCurrentDate(){
		$this->SelectedUser = "";

	}

    public function render()
    {
        return view('livewire.rapport-user');
    }
}

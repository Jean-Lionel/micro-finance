<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ComptePrincipalController;

use App\Models\ComptePrincipal;
use App\Models\ComptePrincipalOperation;
use App\Models\Depense;
use Livewire\Component;
use Livewire\WithPagination;

class DepenseComponent extends Component
{
    use WithPagination;

    public $montant, $action_name, $select_id;
    public $update_mode= false;

    public function render()
    {
    	$data = Depense::sortable()->paginate(20);

    	

        return view('livewire.depenses.component',compact('data'));
    }

    private function resetInput(){
    	$this->montant = null;
    	$this->action_name = null;
        $this->select_id = null;
    }

    public function store(){
    	$this->validate([
    		'montant' => 'required|min:0|numeric',
    		'action_name' => 'required'
    	]);

        $response = ComptePrincipalController::update($this->montant, 'RETRAIT');

        if($response =='OK'){

            
             $res = ComptePrincipalOperation::create(['depense' => $this->montant]);
             // dd($res);
            Depense::create([
                'montant' => $this->montant,
                'action_name' => $this->action_name
            ]);

        }else{
            errorMessage($response);
        }

        successMessage();

        $this->resetInput();

        $this->render();
    }

    public function edit($id){
        $record = Depense::findOrFail($id);

        $this->select_id = $id;

        $this->action_name = $record->action_name;
        $this->montant = $record->montant;

        $this->update_mode = true;

    }

    public function update()
    {
    	$this->validate([
    		'select_id' => 'required|numeric',
    		'montant' => 'required|min:0|numeric',
    		'action_name' => 'required'
    	]);

    	// if($this->select_id){
    	// 	$depense = Depense::find($this->select_id);

    	// 	$depense->update([
    	// 		'montant' => $this->montant,
    	// 		'action_name' => $this->action_name
    	// 	]);

    		$this->resetInput();

    	 	$this->update_mode = false;

    	// 	successMessage();
    	// }

    }



    public function destroy($id)
    {

        // if($id){
        // 	$depense = Depense::where('id',$id);
        // 	$depense->delete();
        // }
    }

}

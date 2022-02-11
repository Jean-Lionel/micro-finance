<?php

namespace App\Http\Livewire;

use App\Models\Decouvert;
use App\Models\WatchUpdateDecouvert;
use Carbon\Carbon;
use DB;
use Livewire\Component;

class UpdateDecourt extends Component
{
    public $decouvert_id;
    public $show_input;
    public $periode;
    public $action;


    public function mount($decouvert){
        $this->decouvert_id = $decouvert;

    }
    public function render()
    {
        return view('livewire.update-decourt');
    }

    protected $rules = [
        'periode' => 'numeric|required|min:1',
        'action' => 'required'
    ];

    public function augmenterPeriode()
    {
       $this->validate($this->rules);
        // code...
        $decouvert = Decouvert::findOrFail($this->decouvert_id);

        try {
            DB::begintransaction();
                /*interet' => $request->interet,
                'periode' => $request->periode,
                'date_fin' =>   $date_fin,
                'total_a_rambourse' => $total_a_rambourse,
                'montant_restant' => $total_a_rambourse*/

                 $interetM = ($decouvert->total_a_rambourse - $decouvert->montant) / $decouvert->periode;
                 $nouvel_solde = $interetM * $this->periode;
                 $decouvert->date_fin= new Carbon($decouvert->date_fin);
                 //Enregistrement des informations avant la modification
                WatchUpdateDecouvert::create([
                    'decouvert_id' => $decouvert->id,
                    'periode' => $this->periode,
                    'action' => $this->action,
                    'user_id' => auth()->user()->id,
                    'description' => $decouvert->toJson(),
                ]);

                //Augmenter la periode
                if ($this->action == '+') {
                    $decouvert->periode += $this->periode;

                    $decouvert->date_fin =  $decouvert->date_fin->addMonths($this->periode);
                    $decouvert->total_a_rambourse +=   $nouvel_solde;
                    $decouvert->montant_restant +=   $nouvel_solde;
                    //$decouvert->user_id =   auth()->user()->id;
                }
                //Diminuer la periode
                if ($this->action == '-') {
                    // code...
                    if($this->periode > $decouvert->periode )
                        throw new \Exception("Periode invalide");
                    
                    $decouvert->periode -= $this->periode;
                    $decouvert->date_fin =  $decouvert->date_fin->subMonths($this->periode);
                    $decouvert->total_a_rambourse -=   $nouvel_solde;
                    $decouvert->montant_restant -=   $nouvel_solde;

                }

                $decouvert->save();

            DB::commit();
            //Reflesh Page
            return redirect(request()->header('Referer'));
        } catch (\Exception $e) {
           DB::rollback(); 
        }
        
    }
}

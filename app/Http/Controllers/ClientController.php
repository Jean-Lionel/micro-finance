<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormClientRequest;
use App\Models\Client;
use App\Models\Compte;
use App\Models\ComptePrincipal;
use Faker\Provider\url;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$clients = Client::sortable()->paginate(10);

      // $result= ComptePrincipalController::store_info(100,'RETRAIT');

      //   dd($result);

        //if (Gate::allows('edit-settings')) {
            // The current user can't update the post...


           // return "Je suis cool";
        //}


        $search = \Request::get('search'); 

        
        $clients = Client::sortable(['created_at' => 'DESC'])
        ->where('nom','like','%'.$search.'%')
        ->orWhere('prenom','like','%'.$search.'%')
        ->orWhere('cni','like','%'.$search.'%')
        ->orWhere('nom_association','like','%'.$search.'%')
        ->orWhere('profession','like','%'.$search.'%')
        ->orWhere('date_naissance','like','%'.$search.'%')
        ->orWhere('antenne','like','%'.$search.'%')
        ->orWhere('created_at','like','%'.$search.'%')
        ->orderBy('nom')
        ->paginate(10);



        return view('clients.index', compact('clients','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new Client;
        return view('clients.create',compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormClientRequest $request)
    {
        $imageName = '';
        if (isset($request->upload_image)) {
            # code...
            $imageName = time().'.'.$request->upload_image->extension();  
            $request->upload_image->move(public_path('img\client_images'), $imageName);

        }

        

        DB::transaction(function() use($request, $imageName) {

            $client = Client::create($request->all()  + ['image' => $imageName ]);

            Compte::create(
                [
                    'montant' => 0,
                    'type_compte' => 'COURANT',
                    'client_id' => $client->id,
                    'name' => 'COO-'.$client->id
                ]
            );
      //
        });


        successMessage();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
       // $compte = Compte::where('client_id', $client->id)->get();


       //return $client->comptes;

        //dd($client);


       return view('clients.show',compact('client'));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {


        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(FormClientRequest $request, Client $client)
    {
        $client->update($request->all());

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        successMessage();

        return back();
    }
}

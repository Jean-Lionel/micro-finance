<?php

namespace App\Http\Controllers;



use App\Models\ComptePlacement;
use App\Models\PlacementClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacementClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $search = \Request::get('search'); 

        $clients = PlacementClient::sortable(['created_at' => 'DESC'])
        ->where('nom','like','%'.$search.'%')
        ->orWhere('prenom','like','%'.$search.'%')
        ->orWhere('cni','like','%'.$search.'%')
        ->orWhere('addresse','like','%'.$search.'%')
        ->orderBy('nom')
        ->paginate(10);
        

        return view('placementClients.index', compact('clients','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client = new PlacementClient();
        return view('placementClients.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
// unique:clients,cni
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'cni' => 'required|unique:placement_clients',

        ]);

        try {

            DB::begintransaction();

            $client = PlacementClient::create($request->all());

            ComptePlacement::create([

                'name' => 'P-'.$client->id,
                'montant' => 0,
                'placement_client_id' => $client->id

            ]);


            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            errorMessage($e->getMessage());
        }

        

        successMessage();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlacementClient  $placementClient
     * @return \Illuminate\Http\Response
     */
    public function show(PlacementClient $placementClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlacementClient  $placementClient
     * @return \Illuminate\Http\Response
     */
    public function edit(PlacementClient $placementClient)
    {
        return view('placementClients.edit',['client' => $placementClient]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlacementClient  $placementClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlacementClient $placementClient)
    {
        $request->validate([
            'nom' => 'required|min:2',
            'prenom' => 'required|min:2',
            'cni' => 'required',

        ]);

        $placementClient->update($request->all());

        successMessage();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlacementClient  $placementClient
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlacementClient $placementClient)
    {
        $placementClient->delete();

        return $this->index();
    }
}

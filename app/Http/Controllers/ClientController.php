<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ComptePrincipalController;
use App\Http\Requests\FormClientRequest;
use App\Models\Client;
use App\Models\ClientHistory;
use App\Models\Compte;
use App\Models\ComptePrincipal;
use Faker\Provider\url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Image;

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
        

        // $compte = Compte::getCompteByName('coo-12');

        // dd( $compte->client);


        $search = \Request::get('search'); 

        $clients = Client::sortable(['created_at' => 'DESC'])
                        ->where(function($query) use($search){
                            $data = explode(" ", $search);
                            $search_elements = array_filter($data);
                            $first_name = current($search_elements) ?? "";
                            $last_name = next($search_elements) ?? "";

                            if($first_name and $last_name){
                                $query->where('nom','like','%'.$first_name.'%')
                                ->where('prenom','like','%'.($last_name).'%');
                            }else{
                                $query->where('nom','like','%'.$first_name.'%')
                                ->orWhere('prenom','like','%'.($first_name).'%')
                                ->orWhere('cni','like','%'.$first_name.'%')
                                ->orWhere('nom_association','like','%'.$first_name.'%')
                                ->orWhere('profession','like','%'.$first_name.'%')
                                ->orWhere('date_naissance','like','%'.$first_name.'%')
                                ->orWhere('antenne','like','%'.$first_name.'%')
                                ->orWhere('created_at','like','%'.$first_name.'%');
                            }
                        })->paginate();

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
            $image = $request->file('upload_image');

            $imageName = time() . '.'. $image->getClientOriginalExtension();

            $destinationPath  = public_path('img\client_images');
            $imageFile = Image::make($image->getRealPath());

            $imageFile->resize(400,400,function($constraint){
                $constraint->aspectRatio();

            })->save($destinationPath .'/'.   $imageName);

            // $destinationPath = public_path('/uploads');
            // $image->move($destinationPath, $imageName);
        }

            // $imageName = time().'.'.$request->upload_image->extension();  
            // $request->upload_image->move(public_path('img\client_images'), $imageName);

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
       
        try {
            DB::beginTransaction();

                 $imageName = '';
                if (isset($request->upload_image)) {
                    # code...
                    $image = $request->file('upload_image');

                    $imageName = time() . '.'. $image->getClientOriginalExtension();

                    $destinationPath  = public_path('img\client_images');
                    $imageFile = Image::make($image->getRealPath());

                    $imageFile->resize(400,400,function($constraint){
                        $constraint->aspectRatio();

                    })->save($destinationPath .'/'.   $imageName);

                    // $destinationPath = public_path('/uploads');
                    // $image->move($destinationPath, $imageName);
                }


                $client->update($request->all() + ['image' => $imageName ]);

                ClientHistory::create( array_merge([
                    'user_id' => auth()->user()->id,
                    'client_id' =>  $client->id,
                ], $client->toArray() ) );
            DB::commit();
            
        } catch (\Exception $e) {
            DB::rollback();
            die($e->getMessage());
        }



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

        try {
            DB::beginTransaction();
            $client->delete();
            foreach ($client->comptes as $compte) {
                $compte->delete();
            }
            DB::commit();  
        } catch (\Exception $e) {
              DB::rollback();
        }
        successMessage();
        return back();
    }
}

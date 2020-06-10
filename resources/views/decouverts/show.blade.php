@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="card" style="width: 40rem;">
			<div class="card-header">
				<h1 class="text-center"> Information complet</h1>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Nom : <b>{{ $client->nom}} </b></li>
				<li class="list-group-item">Prenom : <b>{{ $client->prenom}} </b></li>
				<li class="list-group-item">Carté d'indentité National : <b>{{ $client->cni}} </b></li>
				<li class="list-group-item">Date de naissance : <b>{{ $client->date_naissance}} </b></li>

			</ul>
		</div>
		
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h1>Information de son Compte</h1>
			</div>

			<ul class="list-group list-group-flush">
				<li class="list-group-item"><b>COMPTE NO : </b>  COPDI {{ $compte[0]['id']}} </li>
				<li class="list-group-item"><b>Montant   :</b> <h5>{{ $compte[0]['montant'] }} FBU</h5></li>
				<li class="list-group-item"></li>
				
			</ul>


		</div>
	</div>
</div>




@endsection
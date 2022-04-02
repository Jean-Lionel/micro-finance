@extends('layouts.app')
@section('content')

<div class="row">
	<div class="col-md-6 col-sm-10">
		<div class="card" style="width: 40rem;">
			<div class="card-header">
				<b class="text-center"> Information complet</b>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Nom et prénom :<b>{{ $client->nom}}  {{ $client->prenom}} </b></li>
				<li class="list-group-item">Antenne :<b>{{ $client->antenne}} </b></li>

			{{-- 	<li class="list-group-item">Nom de l'Association :<b>{{ $client->nom_association}} </b></li> --}}
				<li class="list-group-item">Nationalité :<b>{{ $client->nationalite}} </b></li>
				<li class="list-group-item">CNI :<b>{{ $client->cni}} </b></li>
				{{-- <li class="list-group-item">Date et Lieu de délivrance :<b>{{ $client->date_delivrance}} </b></li> --}}	
				<li class="list-group-item">Lieu et Date de naissance : <b>{{ $client->date_naissance}} </b></li>
				<li class="list-group-item">Etat civil : <b>{{ $client->etat_civil}} </b>

					@if ($client->nom_conjoint != 'Null')
						 | Nom du conjoint : <b>{{ $client->nom_conjoint }} </b>
					@endif


				</li>
				
				<li class="list-group-item">Profession : <b>{{ $client->profession}} </b>
					<ul>
						<li>
							Employeur : <b>{{ $client->nom_employeur }}</b> 
						</li>
						<li>
							Employeur : <b>{{ $client->lieu_activite }}</b> 
						</li>
					</ul>
				</li>

				<li class="list-group-item"> <b>{{ 'Addresse'}} </b>

					<table class="table table-hover table-bordered table-responsive-sm">
						<thead>
							<tr>
								<th>Commune</th>
								<th>Quartier</th>
								<th>Rue</th>
								<th>N°</th>
								<th>B.P</th>
								<th>Téléphone</th>
							</tr>
							
						</thead>
						<tbody>
							<tr>
								<td>{{ $client->commune}}</td>
								<td>{{ $client->quartier}}</td>
								<td>{{ $client->rue}}</td>
								<td>{{ $client->address_no}}</td>
								<td>{{ $client->boite_postal}}</td>
								<td>{{ $client->telephone}}</td>
							</tr>
							
						</tbody>
						
					</table>
					
				</li>

			</ul>
		</div>
		
	</div>

	<div class="col-md-6 col-sm-10">
		<div class="card">
			<div class="card-header">
				<b>Information pour son compte</b>
			</div>
			@foreach($client->comptes as $compte)
			<ul class="list-group list-group-flush">
				<li class="list-group-item d-flex justify-content-between">
					<div>
						<b>COMPTE NO : </b>  {{ $compte->name }} 
					</div>
					<div>
					<h5><b>Montant   :</b>  {{ numberFormat($compte->montant) }} FBU</h5></li>
					</div>
				</li>
			</ul>

			@endforeach

			<h5 class="text-center text-info">Noms et prénoms de signataires</h5>

			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_1_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_1_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_1_tel}}
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_2_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_2_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_2_tel}}
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_3_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_3_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_3_tel}}
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<img src="{{ asset('/img/client_images/'.$client->image ) }}" alt="{{ $client->fullName }}" class="img-responsive">
				</li>
				
			</ul>


		</div>
	</div>
</div>




@endsection
@extends('layouts.app')

@section('content')

<div class="row">
	<h4 class="text-center">INFORMATION DU DECOUVERT NUMERO : {{ $decouvert->id }} de {{ $decouvert->clientName }} COMPTE NUMERO  : {{$decouvert->compte_name}}</h4>
	<div class="col-md-6">
		<div class="card">
			<div class="card" style="width: 40rem;">
			<div class="card-header">
				<b class="text-center"> Information du client</b>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Nom et prénom :<b>{{ $decouvert->client()->nom}}  {{ $decouvert->client()->prenom}} </b></li>
				<li class="list-group-item">Antenne :<b>{{ $decouvert->client()->antenne}} </b></li>
			{{-- 	<li class="list-group-item">Nom de l'Association :<b>{{ $decouvert->client()->nom_association}} </b></li> --}}
				<li class="list-group-item">Nationalité :<b>{{ $decouvert->client()->nationalite}} </b></li>
				<li class="list-group-item">CNI :<b>{{ $decouvert->client()->cni}} </b></li>
				{{-- <li class="list-group-item">Date et Lieu de délivrance :<b>{{ $decouvert->client()->date_delivrance}} </b></li> --}}	
				<li class="list-group-item">Lieu et Date de naissance : <b>{{ $decouvert->client()->date_naissance}} </b></li>
				<li class="list-group-item">Etat civil : <b>{{ $decouvert->client()->etat_civil}} </b>

					@if ($decouvert->client()->nom_conjoint != 'Null')
						 | Nom du conjoint : <b>{{ $decouvert->client()->nom_conjoint }} </b>
					@endif
				</li>
				<li class="list-group-item">Profession : <b>{{ $decouvert->client()->profession}} </b>
					<ul>
						<li>
							Employeur : <b>{{ $decouvert->client()->nom_employeur }}</b> 
						</li>
						<li>
							Employeur : <b>{{ $decouvert->client()->lieu_activite }}</b> 
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
								<td>{{ $decouvert->client()->commune}}</td>
								<td>{{ $decouvert->client()->quartier}}</td>
								<td>{{ $decouvert->client()->rue}}</td>
								<td>{{ $decouvert->client()->address_no}}</td>
								<td>{{ $decouvert->client()->boite_postal}}</td>
								<td>{{ $decouvert->client()->telephone}}</td>
							</tr>
							
						</tbody>
						
					</table>
					
				</li>

			</ul>
		</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card">
			<div class="card-title">INFORMATION DU DECOUVERT</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item d-flex justify-content-between">
					<span>COMPTE :</span> <b>{{$decouvert->compte_name}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>montant :</span> <b>{{numberFormat($decouvert->montant)}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>DATE :</span> <b>{{$decouvert->created_at}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>interet :</span> <b>{{$decouvert->interet}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>TOTAL A REMBOURSER :</span> <b>{{numberFormat($decouvert->total_a_rambourse)}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					
					<div>
						<span>PERIODE :</span> <b>{{$decouvert->periode}} (mois)</b>
						@canany(['is-admin','decouvert-manager'])

						<div class="d-block">
							<span class="bg-info mb-2">Modifié par</span>
							@foreach ($decouvert->user_update_decouvert() as $element)
								{{-- expr --}}
								
								<p  style="font-size: 0.8em; display: flex; line-height:1px; ">
									<span class="mr-4">{{ $element->user->first_name .' '.
									$element->user->last_name }}</span>
									
									<span class="mr-4" class="bg-success-">
										Periode : de 
										{{$element->fullDescrition['periode']}} ({{$element->action }})
										{{ $element->periode}} (mois)
									</span>
									<span class="ml-2" style="display: block;">
										Date: {{ $element->created_at}}
									</span>
								</p>
							@endforeach
						</div>

						@endcanany
					</div>
					<div>
						<livewire:update-decourt :decouvert="$decouvert->id" />
					</div>
					
				</li>

				@if(strtotime($decouvert->date_fin) < strtotime(date('Y-m-d')))

				<li class="list-group-item bg-danger d-flex justify-content-between">
					<span>DERNIER DATE DE REMBOURSEMENT :</span> <b>{{$decouvert->date_fin}}</b>
				</li>

				@else
				<li class="list-group-item  d-flex justify-content-between">
					<span>DERNIER DATE DE REMBOURSEMENT :</span> <b>{{$decouvert->date_fin}}</b>
				</li>
				@endif
	
				<li class="list-group-item d-flex justify-content-between">
					<span>MONTANT DEJA PAYE:</span> <b>{{numberFormat($decouvert->montant_payer)}}</b>
				</li>
				<li class="list-group-item d-flex justify-content-between">
					<span>MONTANT RESTANT:</span> <b>{{numberFormat($decouvert->montant_restant)}}</b>
				</li>
				
				
			</ul>
		</div>

	</div>
	
</div>

@endsection
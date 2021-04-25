@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<b>List des personnes qui ont depassé la date de remboursement</b>
	</div>
	<div class="col-md-6">
		
		<div class="col-md-4 col-sm-6">
			<form action="" class="navbar-form navbar-left">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$search ?? ''}}">
					<span class="input-group-btn">
						<button class="btn btn-default-sm" type="submit">
							<i class="fa fa-search"></i>
						</button>
					</span>

				</div>
			</form>
		</div>
		TOTAL DES CLIENTS QUI N'ONT PAS ENCORE PAYE {{$nombre_total ?? 0}} PERSONNES
	</div>



	@if($decouverts)

	<table class="table  table-hover table-striped table-responsive text-right" style="width: 100%;">
		<thead>
			<tr>


				<th>No</th>
				<th>NOM ET PRENOM</th>
				<th>@sortablelink('compte_name','COMPTE')</th>
				<th>@sortablelink('montant','Montant') </th>
				
				<th>Interet en FBU </th>
				<th>@sortablelink('total_a_rambourse','à rembourse') </th>
				<th>@sortablelink('montant_restant','Reste') </th>
				<th>@sortablelink('periode','Periode') </th>
				<th>@sortablelink('date_fin','FIN') </th>
				<th>@sortablelink('paye','Statut') </th>
				<th>@sortablelink('created_at','Date') </th>

				<th>Action</th> 
			</tr>
		</thead>
		<tbody>

			@foreach($decouverts as $key=> $decouvert)
			<tr>
				<td class="text-left">{{$key + 1}}</td>
				<td class="text-left">{{ $decouvert->clientName }}</td>
				<td>{{ $decouvert->compte_name}}</td>
				<td>{{ numberFormat($decouvert->montant)}}</td>
				
				<td>{{ numberFormat($decouvert->total_a_rambourse - $decouvert->montant)}}</td>
				<td>{{ numberFormat($decouvert->total_a_rambourse)}}</td>
				<td class="text-right">{{ numberFormat($decouvert->montant_restant)}}</td>
				<td class="text-center">{{ $decouvert->periode}}</td>
				<td>{{ $decouvert->date_fin}}</td>
				<td>
					@if ($decouvert->paye == 1)
					<span style="color: green">DEJA PAYE</span>
					@endif

					@if ($decouvert->paye ==0)
					<span style="color: red">NON PAYE</span>
					@endif

					
					<td>{{ $decouvert->created_at}}</td>
				<td>
						<a href="{{ route('decouverts.show',$decouvert) }}" class="btn btn-outline-info"><i class="fa fa-eye" aria-hidden="true" title="Afficher plus d'information"></i>
				</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		{{ $decouverts->links()}}


		@endif



		@endsection
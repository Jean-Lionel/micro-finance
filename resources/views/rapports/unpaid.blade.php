@extends('layouts.app')

@section('content')



<div class="container">

	<div>
		<h2 class="text-center">Montant du {{ date('Y-m') }}  :  {{ number_format($montant_total_mensuel) ?? ""}} FBU</h2>


	</div>

	<div>
		<h3>Le Nombre total :  {{count($compte_error)}}</h3>
	</div>


	<table>
		<thead>
			<tr class="text-center">
				
				<th>
					Numero de compte
				</th>
				<th>
					Nom et Prenom
				</th>
				<th>
					Montant du compte
				</th>
			</tr>
		</thead>

		<tbody>

			@foreach($compte_error as $compte)
			 {{-- {{ dump($compte)}} --}}

			 <tr>
			 	<td>{{ $compte->name  }}</td>
			 	<td>{{$compte->client->nom ?? ""}} {{$compte->client->prenom ?? ""}}</td>

			 	<td>{{ $compte->montant  }}</td>
			 </tr>

			@endforeach
			

		</tbody>
	</table>

	
{{-- 
	@foreach($data['compte_error'] as $compte)


	@endforeach --}}


	


</div>


@stop
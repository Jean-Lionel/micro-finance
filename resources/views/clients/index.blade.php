@extends('layouts.app')

@section('content')
<h1>Listes des clients disponible</h1>

<a href="{{ route('clients.create')}}" class="btn btn-info">Ajouter un client</a>

@if($clients)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('nom','Nom')</th>
			<th>@sortablelink('prenom','Prénom') </th>
			<th>@sortablelink('cni','CNI')</th>
			<th>@sortablelink('date_naissance','Date de naissance')</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($clients as $key=> $client)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $client->nom}}</td>
			<td>{{ $client->prenom}}</td>
			<td>{{ $client->cni}}</td>
			<td>{{ $client->date_naissance}}</td>
			<td>
				<a href="{{ route('clients.show',$client) }}" class="btn btn-outline-info btn-sm">show</a>
				<a href="{{ route('clients.edit',$client) }}" class="btn btn-outline-dark btn-sm">Modifier</a>
			
					<form action="{{ route('clients.destroy' , $client) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $clients->links()}}


@endif



@endsection
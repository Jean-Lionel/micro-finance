@extends('layouts.app')

@section('content')
<h1>Listes des placements disponible</h1>

<a href="{{ route('placements.create')}}" class="btn btn-info">Nouvel placement</a>

@if($placements)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('nbre_moi','Periode (mois)') </th>
			<th>@sortablelink('interet_total','Interet Total')</th>
			<th>@sortablelink('place_interet','Place et interet')</th>
			<th>@sortablelink('created_at','Date') </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($placements as $key=> $placement)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $placement->compte_name}}</td>
			<td>{{ $placement->montant}}</td>
			<td>{{ $placement->nbre_moi}}</td>
			<td>{{ $placement->interet_total}}</td>
			<td>{{ $placement->place_interet}}</td>
			<td>{{ $placement->created_at}}</td>
			<td>
				<a href="{{ route('placements.show',$placement) }}" class="btn btn-outline-info">show</a>
				<a href="{{ route('placements.edit',$placement) }}" class="btn btn-outline-dark">Modifier</a>
			
					<form action="{{ route('placements.destroy' , $placement) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $placements->links()}}


@endif



@endsection
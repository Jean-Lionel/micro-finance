@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<h1>Listes des decouverts disponible</h1>
	</div>
	<div class="col-md-6">
		<a href="{{ route('decouverts.create')}}" class="btn btn-info btn-sm">
			<i class="fa fa-plus"></i> Nouvel decouvert</a>

		<a href="{{ route('reboursement-decouverts.create')}}" class="btn btn-info btn-sm">
			<i class="fa fa-plus"></i> Remboursement decouvert</a>
	</div>
</div>


@if($decouverts)

<table class="table table-bordered table-responsive table-inverse table-hover">
	<thead>
		<tr>


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('interet','Interet en %') </th>
			<th>@sortablelink('total_a_rambourse','Taux à rembourse (FBU)') </th>
			<th>@sortablelink('periode','Periode') </th>
			<th>@sortablelink('created_at','Date') </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($decouverts as $key=> $placement)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $placement->compte_name}}</td>
			<td>{{ $placement->montant}}</td>
			<td>{{ $placement->interet}}</td>
			<td>{{ $placement->total_a_rambourse}}</td>
			<td>{{ $placement->periode}}</td>
			<td>{{ $placement->created_at}}</td>
			<td>
				<a href="{{ route('decouverts.show',$placement) }}" class="btn btn-outline-info">show</a>
				<a href="{{ route('decouverts.edit',$placement) }}" class="btn btn-outline-dark">Modifier</a>
			
					<form action="{{ route('decouverts.destroy' , $placement) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $decouverts->links()}}


@endif



@endsection
@extends('layouts.app')

@section('content')
<h1>Listes</h1>

<a href="{{ route('reboursement-decouverts.create')}}" class="btn btn-info">Nouvel Decouvert</a>

@if($reboursementDecouverts)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('interet','Interet en %') </th>
			<th>@sortablelink('total_a_rambourse','Taux à rembourse (FBU)') </th>
			<th>@sortablelink('created_at','Date') </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($reboursementDecouverts as $key=> $placement)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $placement->compte_name}}</td>
			<td>{{ numberFormat($placement->montant)}}</td>
			<td>{{ numberFormat($placement->interet)}}</td>
			<td>{{ numberFormat($placement->total_a_rambourse)}}</td>
			<td>{{ $placement->created_at}}</td>
			<td>
				<a href="{{ route('reboursement-decouverts.show',$placement) }}" class="btn btn-outline-info">show</a>
				<a href="{{ route('reboursement-decouverts.edit',$placement) }}" class="btn btn-outline-dark">Modifier</a>
			
					<form action="{{ route('reboursement-decouverts.destroy' , $placement) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $reboursementDecouverts->links()}}


@endif



@endsection
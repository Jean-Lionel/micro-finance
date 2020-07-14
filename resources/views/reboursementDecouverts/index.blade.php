@extends('layouts.app')

@section('content')
<h1>Listes</h1>

<a href="{{ route('reboursement-decouverts.create')}}" class="btn btn-info">Nouvel Decouvert</a>

@if($reboursementDecouverts)

<table class="table-bordered table-inverse table-hover table-sm">
	<thead>
		<tr>


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('interet','Taux en %') </th>
			<th>Montant Restant </th>
	
			<th>@sortablelink('created_at','Date') </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($reboursementDecouverts as $key=> $remboursementDecouvert)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $remboursementDecouvert->compte_name}}</td>
			<td>{{ numberFormat($remboursementDecouvert->montant)}}</td>
			<td>{{ numberFormat($remboursementDecouvert->decouvert->interet)}}</td>

			<td>{{ numberFormat($remboursementDecouvert->decouvert->montant_restant - $remboursementDecouvert->decouvert->montant)}}</td>


			
			
			<td>{{ $remboursementDecouvert->created_at}}</td>
			<td>
				{{-- <a href="{{ route('reboursement-decouverts.show',$remboursementDecouvert) }}" class=" btn-sm btn-outline-info">show</a> --}}
				<a href="{{ route('reboursement-decouverts.edit',$remboursementDecouvert) }}" class=" btn-sm btn-outline-dark">Modifier</a>
			
					<form action="{{ route('reboursement-decouverts.destroy' , $remboursementDecouvert) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn-sm btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $reboursementDecouverts->links()}}


@endif



@endsection
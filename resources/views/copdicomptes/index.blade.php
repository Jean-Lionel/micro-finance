@extends('layouts.app')

@section('content')
<h1>COMPTE PRINCIPALE DE COPDI</h1>

<a href="{{ route('copdicomptes.create')}}" class="btn btn-info">Ajouter un montant</a>

@if($copdiComptes)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('created_at','Date') </th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($copdiComptes as $key=> $copediCompte)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $copediCompte->montant}}</td>

			<td>{{ $copediCompte->created_at}}</td>
			<td>
				<a href="{{ route('copdiComptes.show',$copediCompte) }}" class="btn btn-outline-info">show</a>
				<a href="{{ route('copdiComptes.edit',$copediCompte) }}" class="btn btn-outline-dark">Modifier</a>
			
					<form action="{{ route('copdiComptes.destroy' , $copediCompte) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $copdiComptes->links()}}


@endif



@endsection
@extends('layouts.app')

@section('content')
<h1>Listes des operations disponible</h1>

<a href="{{ route('operations.create')}}" class="btn btn-info">Ajouter un operation</a>

@if($operations)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('type_operation','Type d\' operation')</th>
			<th>@sortablelink('created_at','Date') </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($operations as $key=> $operation)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $operation->compte_name}}</td>
			<td>{{ $operation->montant}}</td>
			<td>{{ $operation->type_operation}}</td>
			<td>{{ $operation->created_at}}</td>
			<td>
				<!-- <a href="{{ route('operations.show',$operation) }}" class="btn btn-outline-info">show</a> -->
				<a href="{{ route('operations.edit',$operation) }}" class="btn btn-outline-dark btn-sm">Modifier</a>
			
					<form action="{{ route('operations.destroy' , $operation) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $operations->links()}}


@endif



@endsection
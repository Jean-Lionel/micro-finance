@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<h5 class="text-center">Tout les remboursements</h5>
	</div>
	<div class="col-md-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group custom-search-form">
				<input type="text" class="form-control" name="search" placeholder="Entre le numero du compte." value="{{$search ?? 'COO-'}}">
				<span class="input-group-btn">
					<button class="btn btn-default-sm" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>

			</div>
		</form>
	</div>
</div>

<a href="{{ route('reboursement-decouverts.create')}}" class="btn btn-info">Ramboursement</a>

@if($reboursementDecouverts)

<table class="table table-reponsive table-bordered table-sm  table-hover table-striped">
	<thead>
		<tr>


			<th>No</th>
			<th>Nom et Prénom</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant') </th>
			<th>@sortablelink('interet','Taux en %') </th>
			<th>@sortablelink('created_at','Date') </th>

			
			{{-- <th>Action</th> --}}
		</tr>
	</thead>
	<tbody>

		@foreach($reboursementDecouverts as $key=> $remboursementDecouvert)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $remboursementDecouvert->clientName }}</td>
			<td>{{ $remboursementDecouvert->compte_name}}</td>
			<td>{{ numberFormat($remboursementDecouvert->montant)}}</td>
			<td>{{ numberFormat($remboursementDecouvert->decouvert->interet ?? 0)}}</td>

			{{-- <td>{{ numberFormat($remboursementDecouvert->decouvert->montant_restant - $remboursementDecouvert->montant)}}</td> --}}


			
			
			<td>{{ $remboursementDecouvert->created_at}}</td>
			<td>
				{{-- <a href="{{ route('reboursement-decouverts.show',$remboursementDecouvert) }}" class=" btn-sm btn-outline-info">show</a> --}}
				{{-- <a href="{{ route('reboursement-decouverts.edit',$remboursementDecouvert) }}" class=" btn-sm btn-outline-dark">Modifier</a>

				<form action="{{ route('reboursement-decouverts.destroy' , $remboursementDecouvert) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn-sm btn-outline-danger">Delete</button>
				</form> --}}
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $reboursementDecouverts->links()}}


@endif



@endsection
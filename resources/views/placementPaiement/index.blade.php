@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8">
		<h1 class="text-center"> Paiement des placements</h1>	
	</div>
	<div class="col-md-4 col-sm-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group custom-search-form">
				<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$search}}">
				<span class="input-group-btn">
					<button class="btn btn-default-sm" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>

			</div>
		</form>
	</div>
</div>


<a href="{{ route('placementPaiement.create')}}" class="btn btn-info">Nouvel placement</a>

@if($placement_paiments)

<table class="table table-bordered  table-sm  table-hover">
	<thead>
		<tr style="font-size: 0.9rem;">


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant Payé') </th>
			<th>@sortablelink('date_paiment','Date de Paiment') </th>
			<th>MONTANT RESTANT </th>
			
			
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($placement_paiments as $key=> $placement)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $placement->compte_name}}</td>
			<td>{{ $placement->montant}}</td>
			<td>{{ date('Y-m-d', strtotime($placement->date_paiment))}}</td>
			<td>@dump( $placement->compte)</td>
			
			
		</tr>

		@endforeach
	</tbody>
</table>

{{ $placement_paiments->links()}}


@endif



@endsection
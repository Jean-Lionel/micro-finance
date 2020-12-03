@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-6">
				<h1>Tout les placements</h1>	
			</div>
			<div class="col-md-6">
				<a class="p-2 {{set_active_router('placement-client')}}" href="{{ route('placement-client.index') }}">Compte des place</a>
				<a class="p-2 {{set_active_router('placementPaiement')}}" href="{{ route('placementPaiement.index') }}">Paiment des placements</a>
			</div>
		</div>
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


<a href="{{ route('placements.create')}}" class="btn btn-info">Nouvel placement</a>

@if($placements)

<table class="table table-bordered  table-sm  table-hover">
	<thead>
		<tr style="font-size: 0.9rem;">


			<th>No</th>
			<th>@sortablelink('compte_name','COMPTE NO')</th>
			<th>@sortablelink('montant','Montant placé') </th>
			<th>@sortablelink('nbre_moi','Periode (mois)') </th>
			<th>@sortablelink('interet','Interet %') </th>
			<th>@sortablelink('interet_Moi','Intérêt Mensuelle') </th>
			<th>@sortablelink('interet_total','Intérêt total')</th>
			<th>@sortablelink('place_interet','Place avec intérêt')</th>
			<th>@sortablelink('date_placement','Date de placement') </th>
			<th>@sortablelink('date_fin','Fin') </th>
			<th>@sortablelink('montant_restant',"Montant Restant") </th>
			<th>@sortablelink('status',"STATUS") </th>

			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($placements as $key=> $placement)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $placement->compte_name}}</td>
			<td>{{ numberFormat($placement->montant)}}</td>
			<td>{{ $placement->nbre_moi}}</td>
			<td>{{ $placement->interet}}</td>
			<td>{{ $placement->interet_Moi}}</td>
			<td>{{ numberFormat($placement->interet_total)}}</td>
			<td>{{ numberFormat($placement->place_interet)}}</td>
			<td>{{ $placement->date_placement}}</td>
			<td>{{ $placement->date_fin}}</td>
			<td>{{ $placement->montant_restant}}</td>
			<td>

				@if ($placement->status == 'DEJA PAYE')
				{{-- expr --}}
				<span style="color: green">{{ $placement->status}}</span>
				@else
				<span style="color: red">{{ $placement->status}}</span>
				@endif

			</td>
			<td>
				

				<div class="d-flex justify-content-between">

					...
				{{-- 	@if ($placement->status == 'NON PAYE')
						
						<a href="{{ route('finaliser',$placement) }}" class="btn btn-sm btn-warning">Finaliser</a>

						 <a href="{{ route('placements.edit',$placement) }}" class="btn btn-outline-dark btn-sm">Modifier</a>
					@endif
					
					@if ($placement->status == 'DEJA PAYE')
					<button class="btn btn-sm btn-outline-info">Imprimer</button> 
					@endif
 --}}
					
				
				</div>
				


				 {{--
			
					<form action="{{ route('placements.destroy' , $placement) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Delete</button>
				</form> --}}
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $placements->links()}}


@endif



@endsection
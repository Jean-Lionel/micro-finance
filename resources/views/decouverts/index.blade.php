@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-2">
		<b>List</b>
	</div>
	<div class="col-md">
		@can('is-admin')

		<a href="{{ route('decouverts.create')}}" class="btn btn-info btn-sm">
			<i class="fa fa-plus"></i> Nouvel decouvert</a>

			@endcan

			<a href="{{ route('reboursement-decouverts.create')}}" class="btn btn-info btn-sm">
				<i class="fa fa-plus"></i> Remboursement de decouvert
			</a>

			<a class="p-2 btn-info btn-sm" href="{{ route('reboursement-decouverts.index') }}"><i class="fa fa-share"></i>Histoique de Remboursement</a>
		</div>
		<div class="col-md-4 col-sm-6">
			<form action="" class="navbar-form navbar-left">
				<div class="input-group custom-search-form">
					<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$search ?? ''}}">
					<span class="input-group-btn">
						<button class="btn btn-default-sm" type="submit">
							<i class="fa fa-search"></i>
						</button>
					</span>

				</div>
			</form>
		</div>
	</div>



	@if($decouverts)

	<table class="table  table-hover table-striped table-responsive ">
		<thead>
			<tr>


				<th>No</th>
				<th>NOM ET PRENOM</th>
				<th>@sortablelink('compte_name','COMPTE NO')</th>
				<th>@sortablelink('montant','Montant') </th>
				<th>@sortablelink('interet','Interet en %') </th>
				<th>Interet en FBU </th>
				<th>@sortablelink('total_a_rambourse','Taux à rembourse (FBU)') </th>
				<th>@sortablelink('montant_restant','Montant restant (FBU)') </th>
				<th>@sortablelink('periode','Periode') </th>
				<th>@sortablelink('paye','Statut') </th>
				<th>@sortablelink('created_at','Date') </th>

				<th>Action</th> 
			</tr>
		</thead>
		<tbody>

			@foreach($decouverts as $key=> $decouvert)
			<tr>
				<td>{{$key + 1}}</td>
				<td>{{ $decouvert->clientName }}</td>
				<td>{{ $decouvert->compte_name}}</td>
				<td>{{ numberFormat($decouvert->montant)}}</td>
				<td>{{ numberFormat($decouvert->interet)}}</td>
				<td>{{ numberFormat($decouvert->total_a_rambourse - $decouvert->montant)}}</td>
				<td>{{ numberFormat($decouvert->total_a_rambourse)}}</td>
				<td>{{ numberFormat($decouvert->montant_restant)}}</td>
				<td>{{ $decouvert->periode}}</td>
				<td>
					@if ($decouvert->paye == 1)
					<span style="color: green">DEJA PAYE</span>
					@endif

					@if ($decouvert->paye ==0)
					<span style="color: red">NON PAYE</span>
					@endif

					
					<td>{{ $decouvert->created_at}}</td>
					<td class="d-flex justify-content-between">
						{{-- <a href="{{ route('decouverts.show',$decouvert) }}" class="btn btn-outline-info">show</a> --}}

						@if ($decouvert->paye ==0)

						@can('is-admin')

						<a href="{{ route('decouverts.edit',$decouvert) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

						@endcan

						@endif
						

						
							<form action="{{ route('decouverts.destroy' , $decouvert) }}" style="display: inline;" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous supprimer?')">Supprimer</button>
						</form> 


					</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		{{ $decouverts->links()}}


		@endif



		@endsection
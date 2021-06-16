@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-1">
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

			<a class="btn btn-info btn-sm" href="{{ route('reboursement-decouverts.index') }}"><i class="fa fa-share"></i> Histoique de Remboursement</a>

			<a class="btn btn-info btn-sm" href="{{ route('recrouvement') }}"><i class=""></i><i class="fa fa-clock"></i> Recouvrement  <span class="badge badge-danger">{{$nombre_total}}</span> </a>
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

	<table class="table  table-hover table-striped table-responsive text-right table-bordered">
		<thead>
			<tr>


				<th>No</th>
				<th>NOM ET PRENOM</th>
				<th>@sortablelink('compte_name','COMPTE')</th>
				<th>@sortablelink('montant','Montant') </th>
				<th>@sortablelink('interet','Interet') </th>
				<th>Interet en FBU </th>
				<th>@sortablelink('total_a_rambourse','à rembourse') </th>
				<th>@sortablelink('montant_restant','Reste') </th>
				<th>@sortablelink('periode','Periode') </th>
				<th>@sortablelink('date_fin','FIN') </th>
				<th>@sortablelink('paye','Statut') </th>
				<th>@sortablelink('created_at','Date') </th>

				<th>Action</th> 
			</tr>
		</thead>
		<tbody>

			@foreach($decouverts as $key=> $decouvert)
			<tr>
				<td class="text-left">{{$key + 1}}</td>
				<td class="text-left">{{ $decouvert->clientName }}</td>
				<td>{{ $decouvert->compte_name}}</td>
				<td>{{ numberFormat($decouvert->montant)}}</td>
				<td>{{ numberFormat($decouvert->interet)}}</td>
				<td>{{ numberFormat($decouvert->total_a_rambourse - $decouvert->montant)}}</td>
				<td>{{ numberFormat($decouvert->total_a_rambourse)}}</td>
				<td>{{ numberFormat($decouvert->montant_restant)}}</td>
				<td class="text-center">{{ $decouvert->periode}}</td>
				<td>{{ dateFormat($decouvert->date_fin)}}</td>
				<td>
					@if ($decouvert->paye == 1)
					<span style="color: green">DEJA PAYE</span>
					@endif

					@if ($decouvert->paye ==0)
					<span style="color: red">NON PAYE</span>
					@endif

					
					<td>{{ $decouvert->created_at}}</td>
					<td class="d-flex justify-content-between">
						<a href="{{ route('decouverts.show',$decouvert) }}" class="btn btn-outline-info"><i class="fa fa-eye" aria-hidden="true" title="Afficher plus d'information"></i> Afficher
 </a>
						@if ($decouvert->paye ==0)

						@can('is-admin')

						<a href="{{ route('decouverts.edit',$decouvert) }}" class="btn btn-outline-dark btn-sm"><i class="fas fa-edit" title="Modifier"></i>Modifier</a>

						@endcan

						@endif
						 @can('is-admin')
							<form action="{{ route('decouverts.destroy' , $decouvert) }}" style="display: inline;" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger btn-sm" onclick="return confirm('Voulez-vous supprimer?')"><i class="fas fa-trash" title="Modifier"></i>Supprimer</button>
						</form> 
						 @endcan('is-admin')

					</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		{{ $decouverts->links()}}


		@endif



		@endsection
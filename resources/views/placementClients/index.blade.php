@extends('layouts.app')

@section('content')


<div class="row">
	<div class="col-md-8">
		<b>Liste des personnes qui ont les placements</b>	
	</div>
	<div class="col-md-4 col-sm-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group row custom-search-form">

				<input type="text" id="search" class="form-control col-md-8 " name="search" placeholder="Search..." value="{{$search}}" >
				
				<button class="btn btn-default-sm" type="submit">
					<i class="fa fa-search"></i>
				</button>


			</div>
		</form>
	</div>
</div>



<a href="{{ route('placement-client.create')}}" class="btn btn-info">Ajouter un client</a>

@if($clients)

<table class="table table-sm table-bordered table-striped table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('nom','Nom')</th>
			<th>@sortablelink('prenom','Prénom') </th>
			{{-- <th>@sortablelink('cni','CNI')</th> --}}
			<th>Compte de placement</th>
		
			<th>@sortablelink('created_at','created at')</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($clients as $key=> $client)
		<tr>
			
			<td>{{ $key + 1 }}</td>
			<td>{{ $client->nom}}</td>
			<td>{{ $client->prenom}}</td>
			
			<td>{{ $client->getCompteNameById($client->id) }}</td>			
			
			<td>{{ $client->created_at}}</td>
			<td>
				@can('is-admin')
				<a href="{{ route('placement-client.edit',$client) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

				<form class="form-delete" action="{{ route('placement-client.destroy' , $client) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>
				</form>

				@endcan


			</td>


		</tr>

		@endforeach
	</tbody>
</table>

{{ $clients->links()}}


@endif



@endsection


@section('javascript')

<script>

	// let button = document.querySelector('.delete_client')

	// button.on('click', function(e){

	// 	// e.preventDefault()
	// 	// console.log("Je suis cool");

	// });


	jQuery(document).ready(function($) {


		$('.delete_client').on('click',  function(event) {
			 event.preventDefault();
			// console.log("je suis cool");

			let form = $(this).parent()
			//console.log(form);


			swal.fire({
				title: "Vous êtes sûr",
				text: "Une fois le client est supprimé ça sera difficile de le recuperer",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Oui, Je suis sûr',
				cancelButtonText: "Non , Annuler",
				closeOnConfirm: false,
				closeOnCancel: false
			}).then(function(isConfirm){
				
				if(isConfirm.value){

					form.submit();
				}
			})
			});

	})

	
</script>

@stop
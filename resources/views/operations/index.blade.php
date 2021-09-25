@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-1 col-sm-12 badge-dark">
		<p><a href="{{ route('operations.create')}}" class="text-lg-center white-color">Nouvelle opération</a></p>
	</div>
	<div class="col-md-10 col-sm-12">
		<div class="row">
			<div class="col-md-8">
				{{-- <p class="text-center">Tout les opérations</p>	 --}}
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


		<div class="content-data">



			@if($operations)

			<table class="table table-bordered table-sm table-inverse table-hover">
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
						<td>{{ numberFormat($operation->montant)}}</td>
						<td>{{ $operation->type_operation}}</td>
						<td>{{ dateFormat($operation->created_at)}}</td>
						<td>
							<!-- <a href="{{ route('operations.show',$operation) }}" class="btn btn-outline-info">show</a> -->
							@can('is-admin')
							{{-- expr --}}
							<a href="{{ route('operations.edit',$operation) }}" class="btn btn-outline-dark btn-sm delete_operation">Annuler</a>
							@endcan
							
							<button class="btn btn-outline-info btn-sm imprimer" onclick="printBordereau({{$operation->id}})">Imprimer</button>

						{{-- <form action="{{ route('operations.destroy' , $operation) }}" style="display: inline;" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger btn-sm">Delete</button>
						</form> --}}


					</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		{{ $operations->links()}}




			<div class="card text-dark">
				<ul class="list-group">
					<li class="list-group-item text-center">LE {{ date('d-m-Y') }}</li>
					
				</ul>

				<div class="row">
					<div class="col-md-4">
						<li class="list-group-item">

						<div>TOTAL DES VERSEMENTS : </div>
						
						<div><b> {{ number_format($versement) }} # FBU</b></div>
						</li>
						
					</div>

					<div class="col-md-4">

						<li class="list-group-item">
							<div>
								TOTAL DES RETRAITS :
							</div>

							<div>
								<b>{{ number_format($retrait) }} # FBU</b>
							</div>
					  </li>
						
					</div>

					<div class="col-md-4">

						<li class="list-group-item">
							<div>
								CAISSE :
							</div>

							<div>
								<b>{{ number_format($montant_caisse) }} # FBU</b>
							</div>
					  </li>
						
					</div>
				</div>

			
					
			</div>


		@endif

	</div>


</div>
</div>


@endsection


@section('javascript')

<script>

	const formatNumber = (number) => {
		return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'FBU' }).format(number)
	}

	jQuery(document).ready(function($) {


		$('.delete_operation').on('click',  function(event) {
			event.preventDefault();
			// console.log("je suis cool");

			let element = $(this)
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

					let url = element.attr('href');

					$(location).attr('href',url);

				}
			})
		});

	})




	const imprimer = $('.imprimer')

	function printBordereau(id){
		// console.log(id);

		jQuery.get('{{ route('operation_details') }}', {id: id}, function(data, textStatus, xhr) {
		  //optional stuff to do after success

		  if(textStatus === 'success'){

		  	//console.log(data);
		  	const operation = data.operation;
		  	const user = data.user;

		  	console.log(data);

		  	$('.content-data').html(`


		  		
		  		<style type="text/css">
		  		header span
		  		{
		  			display: block;

		  		}

		  		.main-content{
		  			width: 600px;
		  			position: absolute;
		  			transform: translate(50%,0%);

		  		}

		  		.main-content table{
		  			width: 100%;

		  		}

		  		
		  		</style>

		  		<div>
		  		<button onclick="printJS('borderaeau_print','html')">Imprimer</button>
		  		</div>

		  		<div class="main-content" id="borderaeau_print">

		  		<header>
		  		<span>COPDI</span>
		  		<span>Coopérative pour le Développement "<b>INEZA IWACU</b>"</span>
		  		<span>NIF : 4001068602</span>
		  		<span>RC : 11900/18</span>
		  		<span>Adresse : Q. Muramvya, 1<sup>er</sup> AV. N° 60</span>
		  		</header>

		  		<section>
		  		<p>
		  		************************************************************ <br>
		  		<span>${operation.type_operation} EN ESPECES BORDEREAU No :  ${operation.id} </span> <br>
		  		*************************************************************
		  		</p>

		  		<p>du : ${ new Date(operation.created_at).toLocaleString('en-GB',{ timeZone: 'Africa/Bujumbura' })}</p>
		  		<p>
		  		Compte No : ${operation.compte_name}
		  		<br>
		  		Verse par : ${operation.operer_par}
		  		</p>

		  		<p>

		  		Montant Total : ${formatNumber(operation.montant)} <br>


		  		<span> Soit :  <b>${NumberToLetter(operation.montant)} FBU </b></span>

		  		</p>

		  		</section>

		  		<footer>

		  		Agence : ${data.agence_name.toUpperCase() || 'KINAMA'} <br>
		  		Caissier : ${user.first_name} ${user.last_name}
		  		<div>

		  		<span>Signature Caissier : </span> <br>
		  		<hr>
		  		<span>Signature du deposant : </span>
		  		</div>
		  		</footer>

		  		<hr>

		  		<header>
		  		<span>COPDI</span>
		  		<span>Coopérative pour le Développement "<b>INEZA IWACU</b>"</span>
		  		<span>NIF : 4001068602</span>
		  		<span>RC : 11900/18</span>
		  		<span>Adresse : Q. Muramvya, 1<sup>er</sup> AV. N° 60</span>
		  		</header>

		  		<section>
		  		<p>
		  		************************************************************ <br>
		  		<span>${operation.type_operation} EN ESPECES BORDEREAU No :  ${operation.id} </span> <br>
		  		*************************************************************
		  		</p>

		  		<p>du : ${ new Date(operation.created_at).toLocaleString('en-GB',{ timeZone: 'Africa/Bujumbura' })}</p>
		  		<p>
		  		Compte No : ${operation.compte_name}
		  		<br>
		  		Verse par : ${operation.operer_par}
		  		</p>

		  		<p>

		  		Montant Total : ${formatNumber(operation.montant)} <br>


		  		<span> Soit :  <b>${NumberToLetter(operation.montant)} FBU </b></span>

		  		</p>

		  		</section>

		  		<footer>

		  		<hr>
		  		Guichet : Kinama <br>
		  		Caissier : ${user.first_name+' '+ user.last_name}
		  		<div>

		  		<span>Signature Caissier : </span> <br>

		  		<span>Signature du deposant : </span>
		  		</div>

		  		<hr>
		












		  		`);

		  }
		});
		
	}
</script>

@endsection
@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-1 col-sm-12 badge-dark">
		<p><a href="{{ route('operations.create')}}" class="text-lg-center white-color">Nouvelle opération</a></p>
		
		
	</div>
	<div class="col-md-10 col-sm-12">

		<div class="row">
			<div class="col-md-8">

				<p class="text-center">Tout les opérations</p>	
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
					<td>{{ $operation->created_at}}</td>
					<td>
						<!-- <a href="{{ route('operations.show',$operation) }}" class="btn btn-outline-info">show</a> -->
						<a href="{{ route('operations.edit',$operation) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

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


		@endif

		</div>


	</div>
</div>


@endsection


@section('javascript')

<script>

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


		  		<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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

	body{
		position: relative;

	}
	</style>
	
	
</head>
<body>
	<div>
	<button onclick="printJS('borderaeau_print','html')">Imprimer</button>
	</div>

	<div class="main-content" id="borderaeau_print">
		<header>
			<span>COPDI</span>
			<span>CAPITAL SOCIAL : </span>
			<span>Tél : </span>
			<span>Addresse : </span>
			<span>NIF : </span>
		</header>

		<section>
			<p>
			************************************************************ <br>
			 <span>VERSEMENT EN ESPECES BORDEREAU No :  ${operation.id} </span> <br>
			*************************************************************
			</p>

			<p>du : ${operation.created_at}</p>
			<p>
				Compte No : ${operation.compte_name}
				<br>
				Verse par : ${operation.operer_par}
			</p>

			<p>

			Montant Total : ${operation.montant} FBU <br>


			<span> Soit :  <b>${NumberToLetter(operation.montant)} FBU </b></span>

			</p>

		</section>

		<footer>
		
			<hr>
			Guichet : Kinama <br>
			Caissier : ${user.first_name+' '+ user.last_name}
			<div>

				<span>Signature Caissier : </span> <br>
				<hr>
				<span>Signature du deposant : </span>
			</div>

			<hr>
		</footer>
	</div>
	
</body>
</html>




		  		`)

		  }
		});
		
	}
</script>

@endsection
@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-3">

		<form action="" id="formulaire" class="form-inline">
			@csrf
			<input type="text" class="form-control" id="search" name="search" placeholder="Entre le numero de compte" value="">
			<span class="input-group-btn">
				<button class="btn btn-default-sm" type="submit">
					<i class="fa fa-search"></i>
				</button>
			</span>

		</form>
		
	</div>

	<div class="col-md-9" id="decouvert">
		
	</div>
</div>


<form action="{{ route('reboursement-decouverts.store')}}" method="POST">

	@include('reboursementDecouverts._form',['btnTitle' => 'Enregistre'])

</form>


@endsection


@section('javascript')

<script>

	$(document).ready(function() {

		$('#formulaire').on('submit', function(event){

			event.preventDefault()

			$.ajax({
				url: '{{ route('find_decouvert') }}',
				type: 'GET',
				data: {compte_name: $('#search').val()},
			})
			.done(function(data) {
				
				recupere(data.decouverts);
				console.log("success");
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

		});


		function recupere(data){
			console.log(data)
			
			for (var i = 0; i < data.length; i++) {

				console.log(data[i].compte_name)
				
			}

			return 

		}
		
	});
	
	
		

</script>

@endsection
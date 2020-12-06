@extends('layouts.app')

@section('content')


<div class="row">

	<div class="col-md-3">
		{{-- <div  id="search_form">
			<label for="search_v" class="text-justify text-uppercase text-primary">Entre le numéro du compte</label>
			<input type="text" id="search_v"  class="form-control" placeholder="Entre le numéro du compte">
			<input type="submit"  value="ok" id="search_compte">
		</div>
 --}}
		<div class="form-save">
			<form action="{{ route('decouverts.store')}}" method="POST">
				@include('decouverts._form',['btnTitle' => 'Enregistre'])

			</form>
		</div>
	</div>

	<div class="col-md-8 client-info">
		{{-- <button id="print_button" class="btn-info">Imprimer</button>
		<button id="btn_save_decouvert" class="btn-outline-danger">Enregistre</button>
		@include('decouverts.formulaire') --}}
		
	</div>
	
</div>




@endsection



{{-- @section('javascript')

<script>

	jQuery(document).ready(function() {
		let seachKey = $('#search_v')
		let search_form = $('#search_form')

		let search_compte = $('#search_compte')
		console.log("search_compte", search_compte);


		search_form.on('submit', function(event) {
			event.preventDefault()
			alert('je suis cool')
			$.ajax({
				url: '{{ route('historique_compte') }}',
				method : 'GET',
				data: {compte_name: seachKey.val()},
			})
			.done(function(data) {
				console.log(data.client)
				remplire_formulaire(data.client);
				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			
		});


		function remplire_formulaire(client){
			let client_name = $('.client_name')

			client_name.html(`<b>${client.nom +' '+client.prenom} </b>`)
			$('.telephone').html(client.telephone)
			$('.cni').html(client.cni)
			
			
			client_name.css({
				color: 'red',
				background: '#eee'
			});

			$('.client_compte_name').html(seachKey.val());

		}


	});


	$('#print_button').click(function(event) {
		/* Act on the event */
		
		printJS({
			printable : 'print_form',

			type : 'html',

			css : '{{ asset('/css/decouvert_form.css') }}'
		})
	});

	$('#btn_save_decouvert').click(function(event) {
		/* Act on the event */
		alert('CLICK')
	});
	
</script>


@endsection --}}
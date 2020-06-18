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

	@include('reboursementDecouverts._form')
@endsection


@section('javascript')

<script>
	let remplireCase =  (compte_name,montant,decouvert_id,montant_restant,created_at) =>{


$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  //var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('COMPTE No' + compte_name)
  modal.find('.modal-body #compte_name').val(compte_name)
  modal.find('.modal-body #decouvert_id').val(decouvert_id)
  modal.find('#montant_restant').text('Montant restant '+montant_restant + ' FBU')
})



	}

	$(document).ready(function() {

		$('#formulaire').on('submit', function(event){

			event.preventDefault()

			$.ajax({
				url: '{{ route('find_decouvert') }}',
				type: 'GET',
				data: {compte_name: $('#search').val()},
			})
			.done(function(data) {
				console.log("success");

				// console.log(data)
				let table = recupere(data.decouverts);

				//document.getElementById('decouvert').innerHTML = ""
				$('#decouvert').html('')				
				$('#decouvert').append(table)
				
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

		});


		function recupere(data){
			let table = `<table class="table table-hover">
			<thead>
			<tr>
			<th>No du compte</th>
			<th>Montant</th>
			<th>Decouvert No</th>
			<th>Date du decouvert</th>
			<th>Montant restant</th>

			<th>Action</th>
			</tr>
			</thead>
			`;
			
			for (var i = 0; i < data.length; i++) {

				// console.log(data[i])


				let tr = 
				`
				<tr>
				<td>${data[i].compte_name}</td>
				<td>${data[i].montant}</td>
				<td>#${data[i].id}</td>
				<td>${data[i].created_at}</td>
				<td>${data[i].montant_restant}</td>
				
				<td>

				<button type="button" onclick="remplireCase('${data[i].compte_name}',${data[i].montant},${data[i].id},${data[i].montant_restant},'${data[i].created_at}')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" >Paye</button>

				</td>
				</tr>
				`;

				table += tr;
				
			}

			table += '</table>'

			return table;

		}


		
		
	});
	


	


</script>

@endsection
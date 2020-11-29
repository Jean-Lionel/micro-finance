@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-4">

		<form action="" id="formulaire" class="form-inline">
			@csrf
			<input type="text" class="form-control" id="search" name="search" placeholder="Entre le numero de compte" value="">
			<span class="input-group-btn">
				<button class="btn btn-default-sm" type="submit">
					<i class="fa fa-search"></i>
				</button>
			</span>

		</form>

		<div class="modal-body">
			<h5 id="montant_restant"></h5>
			<form action="{{ route('reboursement-decouverts.store')}}" method="POST">
				@csrf
				<div class="row">
					<div class="col-md-12">
						<fieldset class="form-group">
							{{-- <label for="compte_name">Numero du compte</label> --}}
							<input type="hidden" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name"  value="{{ old('compte_name') ?? $reboursementDecouvert->compte_name}}">

							{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>
						<fieldset class="form-group">
							{{-- 	<label for="decouvert_id">Decouvert</label> --}}
							<input type="hidden" class="form-control {{$errors->has('decouvert_id') ? 'is-invalid' : 'is-valid' }}" id="decouvert_id" name="decouvert_id" value="{{ old('decouvert_id') ?? $reboursementDecouvert->decouvert_id }}">

							{!! $errors->first('decouvert_id', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>

					</div>
					<div class="col-md-12">
						<fieldset class="form-group">
							<label for="date_remboursement">Date de remboursement</label>
							<input type="date" class="form-control {{$errors->has('date_remboursement') ? 'is-invalid' : 'is-valid' }}" id="date_remboursement" name="date_remboursement" value="{{ old('date_remboursement') ?? $reboursementDecouvert->date_remboursement }}">

							{!! $errors->first('date_remboursement', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>

					</div>
					<div class="col-md-12">
						<fieldset class="form-group">
							<label for="montant">Montant</label>
							<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant" name="montant" value="{{ old('montant') ?? $reboursementDecouvert->montant }}">

							{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>

					</div>


				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Enregistre</button>
				</div>

			</form>
		</div>
		
	</div>

	<div class="col-md-8" id="decouvert">
		
	</div>
</div>


@endsection


@section('javascript')

<script>

	let remplireCase =  (compte_name,montant,decouvert_id,montant_restant,created_at) =>{

		console.log(compte_name +' '+ montant);

		$('.modal-title').text('COMPTE No' + compte_name)
		$('#compte_name').val(compte_name)
		$('#decouvert_id').val(decouvert_id)
		$('#montant_restant').text('Montant restant '+montant_restant + ' FBU')

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

				<button type="button" onclick="remplireCase('${data[i].compte_name}',${data[i].montant},${data[i].id},${data[i].montant_restant},'${data[i].created_at}')" class="btn btn-primary" class="paye" >Paye</button>

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

@stop
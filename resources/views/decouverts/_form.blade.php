
@csrf

<div class="row">
	
	<div class="col-md-12">
		<h5 class="text-left">Enregistre une nouvel decouvert</h5>
	</div>
	<div class="col-md-4">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $decouvert->compte_name?? 'COO-' }}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $decouvert->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	<div class="col-md-4">
		

		<div class="row">
			<div class="col-md-6">
				<fieldset class="form-group">
			<label for="interet">Interet </label>
			<input type="text" class="form-control {{$errors->has('interet') ? 'is-invalid' : 'is-valid' }}" id="interet" name="interet" value="{{ old('interet') ?? $decouvert->interet ?? 8 }}">

			{!! $errors->first('interet', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>
				
			</div>
			<div class="col-md-6">
				<fieldset class="form-group">
			<label for="periode">periode </label>
			<input type="text" class="form-control {{$errors->has('periode') ? 'is-invalid' : 'is-valid' }}" id="periode" name="periode" value="{{ old('periode') ?? $decouvert->periode ?? 3 }}">

			{!! $errors->first('periode', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>
			</div>
		</div>

		<fieldset>
			<label for=""></label>
			<input type="submit" class="btn btn-outline-primary btn-block"

			value="{{$btnTitle}}" 
			>
		</fieldset>

		
		
	</div>


</div>


@section('javascript')



<script>

	jQuery(document).ready(function() {

		let compte_name = $('#compte_name')

		//console.log(compte_name.val('bonjour'))

		compte_name.on('blur',  function(event) {
			 event.preventDefault();
			/* Act on the event */

			$.ajax({
				url: '{{ route('client_by_compte_name') }}',
				type: 'GET',
				dataType: 'json',
				data: {compte_name: compte_name.val()},
			})
			.done(function(data) {
				

				$('.client-info').html(client_information(data))
				// client_information(data.client);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
			

			
		});
		
	});

	let client_information = (data) => {


		let html = `
			<div class="information">

			<div class="card-group">
				<div class="card">
				<img class="card-img-top" src="/img/client_images/${data.client.image}" width="50px" alt="image" style="width: 200px">
				</div>

				<div class="card">
					<b class="card-title">Nom : ${data.client.nom}</b>
					<b class="card-title">prénom : ${data.client.prenom}</b>
					<b class="card-title">C.N.I : ${data.client.cni}</b>
					<b class="card-title">Date de Naissance :${data.client.date_naissance} </b>
					
				</div>
			</div>
			
		</div>


		<div class="card-columns">
			<div class="card bg-primary">
				<div class="card-body text-center">
					<p class="card-title"> MONTANT </p>
					<p class="card-text">#${data.compte.montant} FBU</p>
				</div>
			</div>
			<div class="card bg-warning">
				<div class="card-body text-center">
					<p class="card-text">Some text inside the second card</p>
				</div>
			</div>
			<div class="card bg-success">
				<div class="card-body text-center">
					<p class="card-text">Some text inside the third card</p>
				</div>
			</div>
			<div class="card bg-danger">
				<div class="card-body text-center">
					<p class="card-text">Some text inside the fourth card</p>
				</div>
			</div>
			<div class="card bg-light">
				<div class="card-body text-center">
					<p class="card-text">Some text inside the fifth card</p>
				</div>
			</div>
			<div class="card bg-info">
				<div class="card-body text-center">
					<p class="card-text">Some text inside the sixth card</p>
				</div>
			</div>
		</div>
		`

		return html;
	}
	
</script>

@endsection

































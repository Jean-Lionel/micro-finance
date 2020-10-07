
@csrf

<div class="row">
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistre une nouvel placement</h5>
	</div>
	<div class="col-md-4">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $placement->compte_name??'COO-' }}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $placement->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	<div class="col-md-4">
		
		<fieldset class="form-group">
			<label for="nbre_moi">Nombre de moi</label>
			<input type="text" class="form-control {{$errors->has('nbre_moi') ? 'is-invalid' : 'is-valid' }}" id="nbre_moi"   name="nbre_moi" value="{{ old('nbre_moi') ?? $placement->nbre_moi }}">
			{!! $errors->first('nbre_moi', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<fieldset class="form-group">
			<label for="interet_total">Interêt total en %</label>
			<input type="text" class="form-control {{$errors->has('interet_total') ? 'is-invalid' : 'is-valid' }}" id="interet_total" name="interet_total" value="{{ old('interet_total') ?? $placement->interet_total ?? 8 }}">

			{!! $errors->first('interet_total', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>
		
	</div>

	<div class="col-md-4">
		
		<fieldset class="form-group">
			<label for="date_placement">Date de placement</label>
			<input type="date" class="form-control {{$errors->has('date_placement') ? 'is-invalid' : 'is-valid' }}" id="date_placement"   name="date_placement" value="{{ old('date_placement') ?? $placement->date_placement }}">
			{!! $errors->first('date_placement', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<div class="form-group">
			<button type="submit" class="btn btn-pill btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>


		
		
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
		
		</div>
		`

		return html;
	}
	
</script>

@endsection
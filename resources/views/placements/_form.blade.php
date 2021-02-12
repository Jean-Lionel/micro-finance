
@csrf

<div class="row">
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistrer une nouvel placement</h5>
	</div>
	<div class="col-md-4">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $placement->compte_name??'P-' }}">

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
			<label for="interet">Interêt total en %</label>
			<input type="text" class="form-control {{$errors->has('interet') ? 'is-invalid' : 'is-valid' }}" id="interet" name="interet" value="{{ old('interet') ?? $placement->interet ?? 8 }}">

			{!! $errors->first('interet', '<small class="help-block invalid-feedback">:message</small>') !!}

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
				url: '{{ route('client_by_compte_placement_name') }}',
				type: 'GET',
				dataType: 'json',
				data: {compte_name: compte_name.val()},
			})
			.done(function(data) {

				if(!data.error){
					$('.client-info').html(client_information(data))

				}else{
					$('.client-info').html(`
						<h5 class= "bg-danger">Numéro matricule est invalidé</h5>
						`)
				}


				
			})
			.fail(function(e) {
				console.log(e);
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
					<b class="card-title">Nom : ${data.client.nom}</b>
					<b class="card-title">prénom : ${data.client.prenom}</b>
					<b class="card-title">C.N.I : ${data.client.cni}</b>
					<b class="card-title">Telephone :${data.client.telephone} </b>
					<b class="card-title">Addresse :${data.client.addresse} </b>
					
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
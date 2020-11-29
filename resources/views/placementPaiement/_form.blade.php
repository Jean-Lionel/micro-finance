
@csrf

<div class="row">
	{{ $errors }}
	
	<div class="col-md-10">
		<h5 class="text-center">Paiment des placements</h5>
	</div>
	<div class="col-md-4">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $placement_paiment->compte_name??'P-' }}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $placement_paiment->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<input type="hidden" value="" id="client_id" name="client_id">

		<div class="form-group">
			<button type="submit" class="btn btn-pill btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>
		

		
	</div>

	<div class="col-md-4">

		<fieldset class="form-group">
			<label for="montant">Date de paiement</label>
			<input type="date" class="form-control {{$errors->has('date_paiment') ? 'is-invalid' : 'is-valid' }}" id="date_paiment"   name="date_paiment" value="{{ old('date_paiment') ?? $placement_paiment->date_paiment }}">
			{!! $errors->first('date_paiment', '<small class="help-block invalid-feedback">:message</small>') !!}
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
				url: '{{ route('client_by_compte_placement_name') }}',
				type: 'GET',
				dataType: 'json',
				data: {compte_name: compte_name.val()},
			})
			.done(function(data) {

				if(!data.error){

					$('#client_id').val(data.client.id);
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

@csrf

<div class="row">
	{{-- {{ $errors }} --}}
	
	<div class="col-md-12">
		<h5 class="text-center">Paiment des placements</h5>

		<span id="same_info" style="background: gold"></span>
	</div>

	<div class="col-md-6">
		
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

		<input type="hidden" value="{{ old('client_id') ?? "" }}" id="client_id" name="client_id">
		<input type="hidden" value="{{ old('placement_id') ?? "" }}" id="placement_id" name="placement_id">
		<input type="hidden" value="{{ old('montant_restant') ?? "" }}" id="montant_restant" name="montant_restant">

		<div class="form-group">
			<button type="submit" class="btn btn-pill btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>
		

		
	</div>

	<div class="col-md-6">

		<fieldset class="form-group">
			<label for="montant">Date de paiement</label>
			<input type="date" class="form-control {{$errors->has('date_paiment') ? 'is-invalid' : 'is-valid' }}" id="date_paiment"   name="date_paiment" value="{{ old('date_paiment') ?? $placement_paiment->date_paiment }}">
			{!! $errors->first('date_paiment', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
		
	</div>



</div>


@section('javascript')



<script>

	function remplireData(data,montant_restant){
		// console.log(data)
		let compte_name = $('#compte_name').val();
		$('#placement_id').val(data);
		$('#montant_restant').val(montant_restant);

		$("#same_info").html(
			`Placement N° ${data} | Montant Restant : # ${_formatNumber(montant_restant)} FBU
			<br> Sur le compte de placement N°: <b> ${compte_name} </b>`)
		console.log($('#placement_id').val())

	}


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

				console.log(data)
			
				if(!data.error){

					$('#client_id').val(data.client.id);
					$('.client-placement').html(loadPlacement(data.placements))
					$('.client-info').html(client_information(data))

				}else{
					$('.client-info').html(`
						<h5 class= "bg-danger">Numéro matricule est invalide</h5>
						`)

					$('.client-placement').html(`
						<h5 class= "bg-danger">Numéro de compte est invalide</h5>
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





			<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">INFORMATION DU CLIENT</h5>
         <ul class="list-group list-group-flush">
   			<li class="list-group-item">Nom : ${data.client.nom}</li>
    		<li class="list-group-item">prénom : ${data.client.prenom}</li>
    		<li class="list-group-item">C.N.I : ${data.client.cni}</li>
    		<li class="list-group-item">Téléphone :${data.client.telephone} </li>
    		<li class="list-group-item">Addresse :${data.client.addresse}</li>
  	</ul>
      
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">INFORMATION DU MANDATAIRE</h5>

        <ul class="list-group list-group-flush">
   			<li class="list-group-item">Nom et prénom : ${data.client.mandataire_name}</li>
    	
    		<li class="list-group-item">C.N.I : ${data.client.mandataire_cni}</li>
    		<li class="list-group-item">Téléphone :${data.client.mandataire_telephone} </li>
    		<li class="list-group-item">Addresse :${data.client.mandataire_addresse}</li>
  	</ul>
        
      </div>
    </div>
  </div>
</div>




		<div class="card-columns">
			<div class="card bg-primary">
				<div class="card-body text-center">
					<p class="card-title"> MONTANT </p>
					<p class="card-text">#${_formatNumber(data.compte.montant)} FBU</p>
				</div>
			</div>
		
		</div>
		`

		return html;
	}



	function loadPlacement(placements){

		// console.log(placements)

		let table = `<table class="table table-hover">
			<thead>
			<tr>
			<th>No du compte</th>
			<th>Montant</th>
			<th>Placement No</th>
			<th>Interêt Mensuel</th>
			<th>Date du placment</th>
			<th>Montant restant</th>

			<th>choisissez l'intérêt à retirer</th>
			</tr>
			</thead>
			<tbody>
			
			`;

			for (var i = 0; i < placements.length; i++) {
				let tr = `<tr>
				<td>${placements[i].compte_name}</td>
				<td>${_formatNumber(placements[i].place_interet)}</td>
				<td>${placements[i].id}</td>
				<td>${_formatNumber(placements[i].interet_Moi)}</td>
				<td>${placements[i].date_placement}</td>
				<td>${_formatNumber(placements[i].montant_restant)}</td>
				<td><button onclick="remplireData(${placements[i].id}, ${placements[i].montant_restant})">Retirer</button></td></td>
				</tr>
				`

				table += tr;
			}


			table += `</tbody>

			</table>`;


		return table;
	}
	
</script>

@endsection
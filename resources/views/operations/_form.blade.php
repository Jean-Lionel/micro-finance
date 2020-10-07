
@csrf

<div class="row">
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistre une nouvel opération</h5>
	</div>
	<div class="col-md-4">
		<fieldset class="form-group">
			<label for="compte_name">Saisir le numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $operation->compte_name ? $operation->compte_nam : 'COO-'}}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group hide">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }} number" id="montant"   name="montant" value="{{ old('montant') ?? $operation->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	<div class="col-md-4 hide">

		<fieldset class="form-group">
			<label for="operer_par">OPERER PAR </label>
			<input type="text" class="form-control {{$errors->has('operer_par') ? 'is-invalid' : 'is-valid' }}" id="operer_par"   name="operer_par" value="{{ old('operer_par') ?? $operation->operer_par }}">
			{!! $errors->first('operer_par', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<fieldset class="form-group">
			<label for="cni">CNI </label>
			<input type="text" class="form-control {{$errors->has('cni') ? 'is-invalid' : 'is-valid' }}" id="cni"   name="cni" value="{{ old('cni') ?? $operation->cni }}">
			{!! $errors->first('cni', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		
	</div>

	<div class="col-md-4 hide">

		<fieldset class="form-group">
			<label for="type_operation">TYPE D'OPERATION</label>
			<select class="form-control {{$errors->has('type_operation') ? 'is-invalid' : 'is-valid' }}" id="type_operation"  name="type_operation">
				<option value="{{ old('type_operation') ?? $operation->type_operation }}">

					{{ old('type_operation') ?? $operation->type_operation ?? 'choississez une opération' }}

				</option>

				@canany(['is-versement-user', 'is-admin'])
				    {{-- expr --}}
				    <option value="VERSEMENT">VERSEMENT</option>
				@endcanany

				@canany(['is-retrait-user', 'is-admin'], Model::class)
				    {{-- expr --}}
				    <option value="RETRAIT">RETRAIT</option>
				@endcanany
				
				
			</select>
			{!! $errors->first('type_operation', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<div class="form-group">
			<button type="submit" class="btn btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>
		
	</div>


</div>





@section('javascript')



<script>

	function isDoubleClicked(element) {
    //if already clicked return TRUE to indicate this click is not allowed
    if (element.data("isclicked")) return true;

    //mark as clicked for 1 second
    element.data("isclicked", true);
    setTimeout(function () {
        element.removeData("isclicked");
    }, 1000);

    //return FALSE to indicate this click was allowed
    return false;
}


	

	function showContent(compte ="",name="",cni=""){

		$('#operer_par').val(name)
		// $('#type_operation').val('RETRAIT')
		$('#cni').val(cni)
		$('#compte_name').attr('disabled','true')

		$('.hide').show()
		

	}



	jQuery(document).ready(function() {
		let hide = $('.hide').hide()

		let compte_name = $('#compte_name')

		
		

		//console.log(compte_name.val('bonjour'))

		compte_name.on('keyup',  function(event) {
			event.preventDefault();
			/* Act on the event */

			$.ajax({
				url: '{{ route('client_by_compte_name') }}',
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

				
				// client_information(data.client);
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
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

			<div class="mt-3">	
			
			<button class="btn btn-success user_compte" onClick="showContent(
			'${data.compte.name}',
			'${data.client.nom} ${data.client.prenom}','${data.client.cni}')" >Nyene compte</button>


			<button class="btn btn-warning" onClick="showContent('${data.compte.name}')" > Uwatumwe</button>

			</div>




			<div class="card-columns">
			<div class="card bg-primary">
			<div class="card-body text-center">
			<p class="card-text">#${data.compte.montant} FBU</p>
			</div>
			</div>


			</div>
			</div>


			`


			return html;
		}



		let save = $('button[type="submit"]')


		save.on('click' , function(event){
			event.preventDefault()
			if (isDoubleClicked($(this))) {

				

				return;
			}


			console.log(event);

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name="_token"]').val()
				}
			});

			let compte_name = $('#compte_name').val()
			let montant = $('#montant').val()
			let operer_par = $('#operer_par').val()
			let type_operation = $('#type_operation').val()
			let cni = $('#cni').val()

			if(compte_name.trim() == "" ||
			 montant.trim() == "" ||
			 operer_par.trim() == "" ||
			 type_operation.trim() == "" ||
			 cni.trim() == "" 

				){
				swal.fire(
					'error',
					'Champs vide',
					'error'
					)

				return ;

			}





			$.ajax({
				url: '{{ route('operations.store')}}',
				type: 'POST',

				data: {
					compte_name,
					montant ,
					operer_par,
					type_operation,
					cni,
					
				},
			})
			.done(function(response) {

				let title = Object.keys(response)[0];
				
				let body = response.error ? response.error : response.success
				

				swal.fire(
					title,
					body,
					title
					)

				if(title == 'success'){

					$('#form_id').trigger("reset");
					
				}

				if(response.success){
					window.location.replace("{{ route('operations.index') }}");

				}

				console.log("success");
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});

		})

		
	});

	
</script>

@endsection
















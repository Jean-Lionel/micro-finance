@extends('layouts.app')


@section('content')


<div class="row">
	<div class="col-md-10">

		<form action="">
			<input type="date" id="date_rapport" name="date_rapport" value="">
		</form>
		<h2 class="text-primary text-center"> RAPPORT JOURNALIERE </h2>
		<button class="btn-info" id="btn_print">Imprimer</button>

		<div class="table-rapport" id="info-print">
			
			
			
		</div>
		
	</div>
	<div class="col-md-2">
		<ul>
			<li class="list-unstyled"><a href="depense" class="">Depense</a></li>
			<li class="list-unstyled"><a href="#" id="tenue_compte">Tenue de compte</a></li>
		</ul>
	</div>
</div>


@stop

@section('javascript')

<script>
	jQuery(document).ready(function(e) {
		let date_r = $('#date_rapport')
		date_r.on('change', function(event) {
			event.preventDefault();

			$.ajax({
				url: '{{ route('rapport') }}',
				type: 'GET',
				data: {date_rapport: date_r.val()},
			})
			.done(function(dta) {
				
				//

				$('.table-rapport').html(loadRapportData(dta.rapport))
			})
			.fail(function() {
				
			})
			.always(function() {
				
			});
			
		});


	});


	function loadRapportData(data) {

		let tbody = (data) => {

			
			let tbdy = ""

			for (var i=0;i< data.length; i++) {
				let tr = `

				<tr>
				<td>${data[i].depense}</td>
				<td>${data[i].total_retrait}</td>
				<td>${data[i].total_versement}</td>		
				<td>${data[i].total_reboursement}</td>			
				<td>${data[i].total_placement}</td>			
				<td>${data[i].created_at}</td>			
				</tr>
				`

				tbdy += tr

			}

			return tbdy
		}

		let body = tbody(data)
		// body...
		let table = `

		<table class="table-hover table table-borderless">
		<thead>

		<tr>
		<th>Depense</th>
		<th>Retrait</th>
		<th>Versement</th>
		<th>Remboursement</th>
		<th>Placement</th>	
		<th>Date</th>	
		</tr>
		</thead>

		<tbody>
		${body}

		</tbody>

		</table>

		`

		if(data[0].created_at == null){

			return `<h2 class="text-center"> Pas de rapport disponible pour la date du 
					${$('#date_rapport').val()}</h2>`

		}


		return table
	}



	//Tenue de compte mensuel

	jQuery(document).ready(function(e) {

		let tenue_compte = $('#tenue_compte')

		tenue_compte.click(function(event) {
			/* Act on the event */

			$.ajax({
				url: '{{ route('tenueMensuelle') }}',
				type: 'GET',
				
			})
			.done(function(data) {
				
				//
				$('.table-rapport').html(tenueHtml(data))
				
			})
			.fail(function() {
				
			})
			.always(function() {
				
			});
			
		});


		let tenueHtml = (data) =>{


			let table_body = (data)=>{
				let tb = ""

				for (let i = 0; i< data.compte_error.length ; i++) {
					let tr = `
					<tr>
					<td>${data.client[i].nom}</td>
					<td>${data.client[i].prenom}</td>
					<td>${data.compte_error[i].name}</td>
					<td>${data.compte_error[i].montant}</td>
					</tr>
					`

					tb+= tr
					
				}

				return tb;
			}
			let tbody = table_body(data);

			let html_data = `

			
			<div id="print_div">

			<p class="badge-warning text-center">Le Montant de tenue de compte  {{date('m').'-'.date('Y')}} est de # ${data.montant_total_mensuel} FBU</p>
			<p class="badge-danger text-center">Les comptes dont le montant de tenue de comptes est insuffisant</p>

			<table class="table table-hover table-sm table-striped">
			<thead>
			<tr>
			<th>NOM</th>
			<th>PRENOM</th>
			<th>NUMERO DE COMPTE</th>
			<th>MONTANT</th>
			</tr>

			</thead>

			<tbody>
			${tbody}
			</tbody>

			</table>

			</div>
			`

			return html_data

		}



		

		
		
	});

		let btn_print = document.getElementById('btn_print')
		
		btn_print.addEventListener('click', function(){
			printJS('print_div','html')
			
		})



	
</script>

@stop
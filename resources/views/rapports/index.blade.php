@extends('layouts.app')


@section('content')


<div class="row">
	
	<div class="col-md-2">
		<ul>
			<li class="list-unstyled"><a href="depense" class="">Depense</a></li>
			<li class="list-unstyled"><a href="#" id="tenue_compte">Tenue de compte</a></li>
		</ul>
	</div>

	<div class="col-md-12">

		<form action="">
			<input type="date" id="date_rapport" name="date_rapport" value="">
		</form>
		<h2 class="text-primary text-center"> RAPPORT JOURNALIERE </h2>
		<button class="btn-info" id="btn_print">Imprimer</button>

		<div class="table-rapport" id="info-print">
			
			
			
		</div>
		
	</div>

	<div class="col-md-4">
		<canvas id="myChart" width="200" height="200"></canvas>
	</div>
	<div class="col-md-4">
		<canvas id="myChart1" width="200" height="200"></canvas>
	</div>
	

	<div class="col-md-4">
		<canvas id="myChart2" width="200" height="200"></canvas>
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


				//data_chart = dta;

				console.log(dta);


				$('.table-rapport').html(loadRapportData(dta.rapport,dta.operation));

				//On dessiner les tableau

				drowChart(dta);

			})
			.fail(function() {
				
			})
			.always(function() {
				
			});
			
		});


	});


	function loadRapportData(data,operation) {


		const formatNumber = (number) => {
			return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'FBU' }).format(number)
		}

		let tbody = (data) => {

			
			let tbdy = ""

			for (var i=0;i< data.length; i++) {
				
				let tr = `

				<tr>
				<td>${formatNumber(data[i].total_depense)}</td>
				<td>${formatNumber(operation.total_retrait)}</td>
				<td>${formatNumber(operation.total_versement)}</td>		
				<td>${formatNumber(data[i].total_decouvert)}</td>		
				<td>${formatNumber(data[i].total_reboursement)}</td>			
				<td>${formatNumber(data[i].total_placement)}</td>			
				<td>${formatNumber(data[i].total_paiment_placement)}</td>			
				<td>${formatNumber(data[i].total_annulation_versement)}</td>			
				<td>${formatNumber(data[i].total_annulation_retrait)}</td>			
				<td>${data[i].created_at}</td>			
				</tr>
				`
				tbdy += tr

			}

			return tbdy
		}



		let body = tbody(data)

		  // `decouvert`, `reboursement`, `tenue_compte`, `annulation_versement`, `annulation_retrait`, `paiment_placement`, `depense`
		// body...
		let table = `

		<table class="table-hover table table-borderless">
		<thead>

		<tr>
		<th>Depense</th>
		<th>Retrait</th>
		<th>Versement</th>
		<th>Decouvert</th>
		<th>Remboursement</th>
		
		<th>Placement</th>
		<th>Paiment des Placement</th>
		<th>Annulation des versements</th>
		<th>Annulation des Retrait</th>
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


//console.log('========================');
//console.log(data_chart);


// var myChart2 = new Chart(ctx2,chartObject);
// var myChart3 = new Chart(ctx3,chartObject);


function drowChart(dta){

	const operation = dta.operation;
	const data = dta.rapport;


	const depense = data[0].total_depense	
	const retrait =	operation.total_retrait;
	const versement	= operation.total_versement;
	const decouvert	= data[0].total_decouvert;
	const remboursement	= data[0].total_reboursement;
	const placement	= data[0].total_placement;
	const paiement_lacement = data[0].total_paiment_placement;
	console.log(versement);


	let data_set =  {
		labels: ['Depense', 'Retrait', 'Versement', 'Decouvert', 'Remboursement', 'Placement','Paiment des Placement'],
		datasets: [{
			label: '# Montant JOURNALIERE',
			data: [depense, retrait, versement, decouvert, remboursement, placement,paiement_lacement],
			backgroundColor: [
			'rgba(255, 99, 132, 0.2)',
			'rgba(54, 162, 235, 0.2)',
			'rgba(255, 206, 86, 0.2)',
			'rgba(75, 192, 192, 0.2)',
			'rgba(153, 102, 255, 0.2)',
			'rgba(255, 159, 64, 0.2)',
			'rgba(150, 159, 64, 0.2)'
			],
			borderColor: [
			'rgba(255, 99, 132, 1)',
			'rgba(54, 162, 235, 1)',
			'rgba(255, 206, 86, 1)',
			'rgba(75, 192, 192, 1)',
			'rgba(153, 102, 255, 1)',
			'rgba(255, 159, 64, 1)',
			'rgba(150, 159, 64, 1)',
			],
			borderWidth: 1
		}]
	};

	let options = {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	};

	let chartObject =  {
		type: 'pie',
		data: data_set,
		options: options
	};
	var ctx = document.getElementById('myChart').getContext('2d');
	var ctx1 = document.getElementById('myChart1').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');
// var ctx3 = document.getElementById('myChart3').getContext('2d');

var myChart = new Chart(ctx,chartObject);
var myChart1 = new Chart(ctx1,{
	type: 'polarArea',
	data: data_set,
	options: options
 });

 var myChart2 = new Chart(ctx2,{
	type: 'line',
	data: data_set,
	options: options
 }


);


}
</script>

@stop
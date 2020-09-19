@extends('layouts.app')

@section('content')

<div class="row text-center">
	<div class="col-md-12 row">
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
		<div class="col-sm-6 col-md-3">
			<div class="col-md">
				<div class="card text-center text-white  mb-3" id="total-orders" style="background-color: #4cb4c7;">
					<div class="card-header">
						<h5 class="card-title">Total Orders</h5>
					</div>
					<div class="card-body">
						<h3 class="card-title">0</h3>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	

{{-- 	<div class="col-md-12">
		@livewire(('general-chart')
	</div> --}}
	
	<div class="col-md-6 col-sm-12">
		@livewire('general-chart')
		
	</div>


	
	{{-- <div class="col-md-6 col-sm-12">
		<canvas id="graphique1" width="200" height="100">
			Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
		</canvas>
	</div>
	<div class="col-md-6 col-sm-12">
		<canvas id="graphique2" width="200" height="100">
		</canvas>
	</div>
	<div class="col-md-6 col-sm-12">
		<canvas id="graphique3" width="200" height="100">
		</canvas>
	</div>
	<div class="col-md-6 col-sm-12">
		<canvas id="graphique4" width="200" height="100">
		</canvas>
	</div> --}}
</div>

@endsection

@section('javascript')

{{-- <script>
	var ctx1 = document.getElementById('graphique1').getContext('2d');
	var ctx2 = document.getElementById('graphique2').getContext('2d');
	var ctx3 = document.getElementById('graphique3').getContext('2d');
	var ctx4 = document.getElementById('graphique4').getContext('2d');


	var char1 = new Chart(ctx1,{
		type: 'bar',
		data: {
			labels: ['DEPENSES', 'RETRAIT', 'VERSEMENT', 'PLACEMENT', 'DECOUVERT', 'COMPTE PRINCIPALE'],
			datasets: [{
				label: 'ETAT ACTUELL DU COMPTE',
				data: [42000, 30000, 150000, 20000,100000 , 150000],
				backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
				],
				borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
				],
				borderWidth: 1
			}]
		},
		options: {
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
	})
	var char2 = new Chart(ctx2,{
		type:'line',
		data:{
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets: [{
				label: 'My First dataset',
				backgroundColor: 'rgb(255, 99, 132)',
				borderColor: 'rgb(255, 99, 132)',
				data: [0, 10, 5, 2, 20, 30, 45],
			}]
		}
	})
	var char3 = new Chart(ctx3,{
		type:'bar',
		data:{
			labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
			datasets:[
			{
				label : 'My area data set',
				data : [20,40,25,54,40,25,1]
			}
			]

		}

	})
	var char4 = new Chart(ctx4,{
		type: 'pie',


	})
	
</script> --}}

@endsection()


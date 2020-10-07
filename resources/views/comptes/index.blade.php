@extends('layouts.app')

@section('content')
<div class="row">
	{{-- <div class="col-md-8">
		<h1>Listes des comptes disponible</h1>	
	</div> --}}
	<div class="col-md-4 col-sm-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group custom-search-form">
				<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$search ?? ''}}">
				<span class="input-group-btn">
					<button class="btn btn-default-sm" type="submit">
						<i class="fa fa-search"></i>
					</button>
				</span>

			</div>
		</form>
	</div>
</div>


@if($comptes)

<table class="table table-bordered table-inverse table-sm table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('client_id','Nom et prenom')</th>
			<th>@sortablelink('name','Numéro de compte')</th>
			<th>@sortablelink('montant','Montant (FBU)') </th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($comptes as $key=> $compte)
		<tr>
			<td>{{$key + 1}}</td>
			<td>

				@if ($compte->client)
					{{ $compte->client->nom .' '.$compte->client->prenom ?? ''}}</td>
				@endif

				
			<td>{{ $compte->name }}</td>
			<td>{{ numberFormat($compte->montant) }}</td>
			<td>
				{{-- 	<a href="{{ route('comptes.show',$compte) }}" class="btn btn-outline-info btn-sm">show</a> --}}
				<a href="{{ route('comptes.edit',$compte) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

				<button class="btn-sm btn-info"  onclick="showHistory('{{$compte->name}}')">historique</button>

					{{-- <form action="{{ route('comptes.destroy' , $compte) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Supprime</button>
				</form> --}}
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $comptes->links()}}


@endif

<button class="btn-warning" id="btn_print" style="font-size:20px"><i class="fa fa-print" ></i> imprimer</button>
<div class="table_info" id="print_value">
	
</div>


@endsection

@section('javascript')

<script>
	//Variable permmettant d'afficher l'iprimater ou non
	showPrintButton(false)

	function showHistory(name){
		

		$.ajax({
			url: '{{ route('historique_compte') }}',

			data: {compte_name: name},
		})
		.done(function(data) {
			
			showPrintButton(true)
			
			let table_generate =  generateEmployeHistory(data)

			$('.table_info').html(table_generate)

			
		})
		.fail(function() {
			
		})
		.always(function() {
			
		});


	}
	

	function generateEmployeHistory(data){

		const operations = data.operations;
		const paiement_placement = data.paiement_placement ;
		const tenus_comptes = data.tenus_comptes;
		const client = data.client;

		const compte_name = data.operations[0].compte_name;


		let table_paiement_placement = '';
		let table_operation =''
		let table_tenus_comptes = ''

		table_operation = `<table class="table table-bordered"> 
		<tr>
		<th> Date </th>
		<th> TYPE D'OPERATION </th>
		<th> MONTANT </th>
		<th> OPERER PAR </th>
		</tr>

		`;

		

		for (var i = 0; i < operations.length; i++) {
			let tr = `<tr>
			<td>${ _formatDate(operations[i].created_at)}</td>
			<td>${operations[i].type_operation}</td>
			<td>${_formatNumber(operations[i].montant)}</td>
			<td>${operations[i].operer_par}</td>

			</tr>`

			table_operation += tr;

		}
		table_operation += '</table>';

		table_paiement_placement = `<table class="table-bordered table"> 
		<thead>
		<tr>
		<th> Date </th>
		<th> MONTANT </th>
		</tr>
		</thead>

		`;



		for (var i = 0; i < paiement_placement.length; i++) {
			
			let tr = `<tr>

			<td> ${_formatDate(paiement_placement[i].created_at)}</td>
			<td> ${_formatNumber(paiement_placement[i].montant)}</td>
			</tr>`;

			table_paiement_placement += tr;

		}

		table_paiement_placement += '</table';


		table_tenus_comptes = `<table class="table table-bordered"> 
		<thead>
		<tr>
		<th> Date </th>
		<th> MONTANT </th>
		</tr>
		</thead>

		`;

		
		for (var i = 0; i < tenus_comptes.length; i++) {
			let tr = `<tr>

			<td> ${_formatDate(tenus_comptes[i].created_at)}</td>
			<td> ${_formatNumber(tenus_comptes[i].montant)}</td>
			</tr>`;

			table_tenus_comptes += tr;
			
		}
		table_tenus_comptes += '</table>'


		return generateHeader(table_operation,table_tenus_comptes,table_paiement_placement,client,compte_name)


	}


	//La function generant le tableau complet

	function generateHeader(table_operation,table_tenus_comptes,table_paiement_placement,client,compte_name){
		let body = `
		

		<div class="historique container" id="print_content">

		<h4 class="text-center text-uppercase">Coopérative pour le Développement "INEZA IWACU"</h4>
		<hr>
		<table width="100%">
		<tr>
		<td width="80%">
		<p style="display: inline-block; position: relative;top: 0">
		<img src="/logo/lion.jpg" width="80px"  alt="Logo">
		</p>



		</td>
		<td width="30%" style="text-align: right;">
		<p>COOPDI</p>
		<p>NIF : <span>4 001 068 602</span></p>
		<p>R.C : <span>11900/18</span></p>
		<p>Q. Muramvya 1 <sup>ère</sup> AV: N° 60</p>

		</td>
		</tr>
		</table>

		<table width="100%">
		<tr>
		<td width="70%">
		<p>Nom et Prénom : <b>${client.nom +' '+ client.prenom}</b></p>
		<p>BUJUMBURA - BURUNDI</p>
		</td>
		<td width="30%" style="text-align: center;">

		<ul style="list-style: none;">
		<li><span>DATE </span> : <b>${_formatDate(new Date())}</b></li>
		<li><span>COMPTE</span> : <b> ${compte_name} </b></li>
		</ul>

		</td>
		</tr>
		</table>

		<div class="table_info">
		<div>
		<h3 class="text-center"> Opération effectuer sur votre compte</h3>
		${table_operation}
		</div>
		<hr>
		<div>
		<h3 class="text-center"> Tenus du compte</h3>
		${table_tenus_comptes}

		</div>
		<hr>
		<div>
		<h3 class="text-center">Rembourssement sur votre placement</h3>
		${table_paiement_placement}
		</div>


		</div>
		</div>


		`

		return body;
	}


	function _formatDate(given_date){
		const dte = new Date(given_date);

		return `Le ${ dte.getDate()}-${dte.getMonth() + 1}-${dte.getFullYear()} `
	}

	function _formatNumber(geven_number){
		
		let formatter = new Intl.NumberFormat().format(geven_number)

		return formatter;
	}



	jQuery(document).ready(function() {


		let btn_print = $('#btn_print')

		btn_print.on('click', function(){
			printJS('print_value','html')

		})
		
	});

	function showPrintButton(val){
		let btn_print = $('#btn_print')

		if(val){
			btn_print.show()
		}else{
			btn_print.hide()
		}

	}

	

	
</script>


@endsection
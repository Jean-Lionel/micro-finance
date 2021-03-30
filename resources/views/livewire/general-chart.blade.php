<div>
	{{-- Do your work, then step back. --}}

	<div class="row">

		<div class="col-md-12">
			<h5> Les comptes de gestion (#FBU)</h5>
			<table class="table table-sm  table-striped table-info ">
				<thead style="font-size: 0.6rem;">
					<tr>
						<th>DEPENSE</th>
						<th>RETRAIT</th>
						<th>VERSEMENT</th>
						<th>PLACEMENT</th>
						<th>DECOUVERT</th>
						<th>COMPTE PRINCIPAL</th>
						<th>TENUE DE COMPTE</th>
						<th>REMBOURSEMENT</th>
						<th>Versement Annulé</th>
						<th>Retrait  Annulé</th>
						
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<td>{{number_format($depense)}}</td>
						<td>{{number_format($retrait)}}</td>
						<td>{{number_format($versement)}}</td>
						<td>{{number_format($placement)}}</td>
						<td>{{number_format($decouvert)}}</td>
						<td>{{number_format($currentMontant)}}</td>
						<td>{{number_format($tenue_compte)}}</td>
						
						<td>{{number_format($remboursement)}}</td>
						<td>{{number_format($annulation_versement)}}</td>
						<td>{{number_format($annulation_retrait)}}</td>
					
						
					</tr>
					
				</tbody>
				
			</table>
		</div>
	</div>
	<div class="col-md-6">
		<canvas id="graphique1" width="200" height="100">
		Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
	</canvas>
	</div>

	{{-- <div class="col-md-6">
		<canvas id="graphique2" width="200" height="100">
		Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
	</canvas> --}}
	</div>


	



</div>
{{-- 
<style>
	color:#FFF;
</style> --}}


@push('scripts')
<script type="text/javascript">

	let compte_principal = {{$currentMontant}};
	let versement = {{$versement}};
	let placement = {{$placement}};
	let retrait = {{$retrait}};
	let decouvert = {{$decouvert}};
	let tenue_compte = {{$tenue_compte}};
	let depense = {{$depense}};
	let remboursement = {{$remboursement}};


	var ctx1 = document.getElementById('graphique1').getContext('2d');
	//var ctx2 = document.getElementById('graphique2').getContext('2d');
	var char1 = new Chart(ctx1,{
		type:'bar',
		data:{
			labels: ['DEPENSES', 'RETRAIT', 'VERSEMENT', 'PLACEMENT', 'DECOUVERT', 'COMPTE PRINCIPAL','TENUE DE COMPTE','REMBOURSEMENT'],
			datasets: [{
				label: 'Valeur actuel en FBU #',
				backgroundColor: [
				'#d14130',
				'#99c93d',
				'rgba(255, 99, 139,0.5)',
				'rgba(25, 99, 12,0.5)',
				'rgba(255, 99, 132,0.5)',
				'rgba(10,80,255,0.5)',
				'rgba(10,80,10,0.5)',

				],
				borderColor: '#000',
				data: [depense, retrait, versement, placement, decouvert, compte_principal,tenue_compte,remboursement],
			}]
		},
		responsive: true
	})


</script>
@endpush

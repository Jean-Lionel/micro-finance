<div>
	{{-- Do your work, then step back. --}}
	<canvas id="graphique1" width="200" height="100">
		Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
	</canvas>



</div>


@push('scripts')
<script type="text/javascript">

	let compte_principal = {{$currentMontant}};
	let versement = {{$versement}};
	let placement = {{$placement}};
	let retrait = {{$retrait}};
	let decouvert = {{$decouvert}};
	let tenue_compte = {{$tenue_compte}};
	let depense = {{$depense}};


    var ctx2 = document.getElementById('graphique1').getContext('2d');
		var char2 = new Chart(ctx2,{
			type:'bar',
			data:{
				labels: ['DEPENSES', 'RETRAIT', 'VERSEMENT', 'PLACEMENT', 'DECOUVERT', 'COMPTE PRINCIPALE','TENUE DE COMPTE'],
				datasets: [{
					label: 'Valeur actuel en FBU #',
					backgroundColor: [
					'#d14130',
					'#99c93d',
					'rgba(255, 99, 132,0.5)',
					'rgba(255, 99, 132,0.5)',
					'rgba(255, 99, 132,0.5)',
					'rgba(10,80,255,0.5)',

					],
					borderColor: '#000',
					data: [depense, retrait, versement, placement, decouvert, compte_principal,tenue_compte],
				}]
			}
		})


</script>
@endpush

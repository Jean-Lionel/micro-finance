<div>
	{{-- Do your work, then step back. --}}
	<canvas id="graphique1" width="200" height="100">
		Ooops !!! votre navigateur n'est pas à jour essayer de chercher les derniers mise à jour
	</canvas>



</div>


@push('scripts')
<script type="text/javascript">
    var ctx2 = document.getElementById('graphique1').getContext('2d');
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
</script>
@endpush

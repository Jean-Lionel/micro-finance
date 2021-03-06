<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}

    <div class="row">
    	

    	<table class="table">
    		<thead>
    			<tr>
    				<th>NUMERO</th>
    				<th>COMPTE</th>
    				<th>NOM ET PRENOM</th>
    				<th>MONTANT</th>
    			</tr>
    		</thead>
    		<tbody>
    			@foreach($comptes as $key => $compte)
    			<tr>
    				<td>{{ ++ $key}}</td>
    				<td>{{ $compte->name}}</td>
    				<td>{{ $compte->membre->fullName}}</td>
    				<td>{{ numberFormat(abs($compte->montant))}}</td>
    			</tr>

    			@endforeach
    		</tbody>
    	</table>
    </div>
</div>

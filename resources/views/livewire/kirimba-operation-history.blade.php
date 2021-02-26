<div>
    {{-- Be like water. --}}

    <h1>Historique des opérations</h1>

    <div class="row">
    	<label for="" class="col-md-5">Rechecher ici</label>
    	<input type="text" placeholder="Rechecher ici !!!" wire:model="compte_name" value="K-" class="col-md-4 form-control">
    </div>

   


    <table class="table table-bordered table-hover">
    	<thead>
    		<tr>
    			<th>Numero de Compte</th>
    			<th>TYPE D'OPERATION</th>
    			<th>MONTANT</th>
    			<th>DATE</th>
    		</tr>
    		
    	</thead>

    	<tbody>
    		
    		@foreach($operations as $operation)
    		<tr>
    			
    			<td>{{ $operation->compte_name }}</td>
    			<td>{{ $operation->type_operation }}</td>
    			<td>{{ $operation->montant }}</td>
    			<td>{{ $operation->created_at }}</td>
    		</tr>

    		@endforeach
    	</tbody>
    </table>

</div>

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
                <th>BENEFICE</th>
    			<th>DATE</th>
                <th>ACTION</th>
    		</tr>
    		
    	</thead>

    	<tbody>
    		
    		@foreach($operations as $operation)
    		<tr>
    			
    			<td>{{ $operation->compte_name }}</td>
    			<td>{{ $operation->type_operation }}</td>
    			<td>{{ number_format($operation->montant) }}</td>
                <td>{{ number_format($operation->benefice) ?? 0 }}</td>
    			<td>{{ dateFormat( $operation->created_at ) }}</td>
                <td>
                    {{-- <button wire:click="updateOperation({{$operation->id}})">Modifier</button> --}}
                    <button wire:click="$emit('triggerDelete',{{ $operation->id }})">Annuler</button>
                </td>
    		</tr>

    		@endforeach
    	</tbody>
    </table>

</div>

@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', orderId => {
            Swal.fire({
                title: 'êtez vous sûr ?',
                text: "D'annuler cet opération",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'OK!',
                cancelButtonText: 'NON'
            }).then((result) => {
        //if user clicks on delete
                if (result.value) {
             // calling destroy method to delete
                    @this.call('deleteOperation',orderId)
            // success response
                    responseAlert({title: session('message'), type: 'success'});
                    
                } else {
                    responseAlert({
                        title: 'Operation Cancelled!',
                        type: 'success'
                    });
                }
            });
        });
    })
</script>
@endpush


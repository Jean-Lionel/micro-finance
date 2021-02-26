<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}} 

    {{--CREATION D'UN NOUVEAU MEMBRE --}}

    @if($showForm)

    <div class="offset-md-2">
    	<h3 class="text-center col-md-8">Ajout d'un nouveau membre</h3>
    	<form action="" wire:submit.prevent="enregistrerMembrer">
    		<div class="row">
    			<div class="form-group col-md-4 ">
	    			<label for="">Nom</label>
	    			<input type="text" wire:model="first_name" class="form-control">

	    			@error('last_name')
	    			<span class="error danger">{{ $message }}</span>

	    			@enderror
    			</div>

    			<div class="form-group col-md-4">
	    			<label for="">Prénom</label>
	    			<input type="text" wire:model="last_name" class="form-control">

	    			@error('first_name')
	    			<span class="error danger">{{ $message }}</span>

	    			@enderror
    			</div>
    			<div class="col-md-4"></div>

    			<div class="form-group col-md-4">
	    			<label for="">CNI</label>
	    			<input type="text" wire:model="cni" class="form-control">

	    			@error('cni')
	    			<span class="error text-danger">{{ $message }}</span>

	    			@enderror
    			</div>

    			<div class="form-group col-md-4">
	    			<label for="">Téléphone</label>
	    			<input type="text" wire:model="telephone" class="form-control">

	    			@error('telephone')
	    			<span class="error text-danger">{{ $message }}</span>

	    			@enderror
    			</div>
    			<div class="col-md-4">
    				
    			</div>

    			<div class="form-group col-md-4">
	    			<label for="">Addresse</label>
	    			<input type="text" wire:model="addresse" class="form-control">

	    			@error('addresse')
	    			<span class="error danger">{{ $message }}</span>

	    			@enderror
    			</div>
    			<div class="col-md-4">
    				<button class="btn btn-primary mt-4 btn-block" type="submit">Enregistrer</button>
    				
    			</div>
    			
    		</div>
    		
    		
    	</form>
    </div>

    @endif

    <div class="list">
    	<div class="row  mb-2">
    		<div class="col-md-6">
    			<button class="btn btn-info" wire:click="taggleShowForm">Ajouter un nouveau Membre</button>
    		</div>
    		<div class="col-md-6">
    			<input type="text" wire:model="search" class="form-control" placeholder="Rechercher ici !!!"> 
    			
    		</div>
    	</div>
    	

    	<table class="table table-hover">
    		<thead class="table-info">
    			<tr>
    				<th>COMPTE </th>
    				<th>NOM </th>
    				<th>PRENOM </th>
    				<th>TELEPHONE </th>
    				<th>CENI </th>
    				<th>ADDRESSE </th>
    				<th>ACTION </th>
    				
    			</tr>
    			
    		</thead>

    		<tbody>
    			@foreach($membres as $membre)
    			<tr>
    				<td>{{ $membre->compte->name ?? "" }}</td>
    				<td>{{ $membre->first_name }}</td>
    				<td>{{ $membre->last_name }}</td>
    				<td>{{ $membre->telephone }}</td>
    				<td>{{ $membre->cni }}</td>
    				<td>{{ $membre->addresse }}</td>
    				<td class="d-flex justify-content-around" >
    					<button wire:click="modifierMembre({{ $membre->id  }})" class="btn badge-warning">Modifier</button>
                        @can('is-admin')
    					<button wire:click="$emit('triggerDelete',{{ $membre->id }})" class="btn badge-danger ">Supprimer</button>
                        @endcan

    				</td>	
    			</tr>

    			@endforeach
    			
    		</tbody>
    	</table>
    	{{ $membres->links() }}
    </div>

</div>


@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {

        @this.on('triggerDelete', orderId => {
            Swal.fire({
                title: 'Are You Sure?',
                text: 'Order record will be deleted!',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'Delete!'
            }).then((result) => {
		//if user clicks on delete
                if (result.value) {
		     // calling destroy method to delete
                    @this.call('supprimerMemebre',orderId)
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

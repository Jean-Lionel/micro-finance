<div>
    {{-- The best athlete wants his opponent at his best. --}}
    <div class="row">
    	<div class="col-md-3">
    		<form action="" wire:submit.prevent="saveCaisseOperation">
    			<div class="form-group">
    				<label for="">CAISSIER</label>
    				<select name="" id="" wire:model="user_id" class="form-control">
    					<option value="">...Selectionnez ...</option>
    					@foreach ($users as $user)
    					{{-- expr --}}
    					<option value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
    				    @endforeach
    				</select>
    				@error("user_id")
    				<p class="text-danger">{{ $message }}</p>
    				@enderror
    			</div>
    			<div class="form-group">
    				<label for="">Montant</label>
    				<input wire:model="montant" type="text" class="form-control">
    				@error("montant")
    				  <p class="text-danger">{{ $message }}</p>
    				@enderror
    			</div>
    			<div class="form-group">
    				<button class="btn btn-info">CREDITER</button>
    			</div>
    		</form>
    	</div>
    	<div class="col-md-8">
    		<table class="table tab-content">
    			<thead class="table-hover table-info">
    				<tr>
    					<th>NOM ET PRENOM</th>
                        <th>AGENCE</th>
    					<th>MONTANT ( FBU )</th>
    					<th>VALIDATION</th>
    				</tr>
    			</thead>
    			<tbody>
    				@foreach ($caisse_caissiers as $caisse)
    				<tr>
    					<td>{{ $caisse->user->fullName }}</td>
                        <td>{{ $caisse->user->agence->name ?? "" }}</td>
    					<td>{{ numberFormat($caisse->montant) }}</td>
    					<td>
                            @if($caisse->montant > 0) 
    						<button class="btn-sm btn-info" wire:click="$emit('confirmValidation',{{$caisse->id}})">Validation</button>
                            @endif
    					</td>
    				</tr>
    				@endforeach	
    			</tbody>
    		</table>	
    	</div>
    </div>
</div>


@push("scripts")
<script type="text/javascript">

    document.addEventListener("DOMContentLoaded",function(e){
          @this.on('confirmValidation', orderId => {
            Swal.fire({
                title: 'êtez vous sûr ?',
                text: 'de Valider cette opération',
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: 'var(--success)',
                cancelButtonColor: 'var(--primary)',
                confirmButtonText: 'Valider !'
            }).then((result) => {
        //if user clicks on delete
                if (result.value) {
             // calling destroy method to delete
                    @this.call('vaideReception',orderId)
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
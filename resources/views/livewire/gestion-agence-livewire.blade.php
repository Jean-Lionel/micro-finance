<div>
    {{-- Do your work, then step back. --}}

    <div class="form">
    	<form action="" wire:submit.prevent="saveMontantAgence">
    		<div class="form-group row">
    			<label for="" class="col-md-1">AGENCE</label>
    			<select name="" id="" class="form-control col-md-2" wire:model="agence_id">
    				<option value="">..Select </option>
    				@foreach ($agences as $agence)
    					{{-- expr --}}
    					<option value="{{$agence->id}}">{{$agence->name}} </option>
    					
    				@endforeach

    			</select>
    			@error("agence_id")
    			<span>{{$message}}</span>
    			@enderror

    			<label for="" class="col-md-1">MONTANT</label>
    			<input type="number" wire:model="montant" class="form-control col-md-2">
    			@error("montant")
    			<span>{{$message}}</span>
    			@enderror
    			<input type="submit" class="btn btn-info col-md-2 ml-1"  value="Valider">

    		</div>
    	</form>
    </div>

   <table class="table-sm table">
   	
   	<thead>
   		<tr>
   			<th>#</th>
   			<th>AGENCE </th>
   			<th>MONTANT</th>
   		</tr>
   	</thead>

   	<tbody>
   		@foreach ($agences as $key=>$agence)
   			{{-- expr --}}
	   		<tr>
	   			<td>{{ ++ $key}}</td>
	   			<td>{{ $agence->name}}</td>
	   			<td>{{ numberFormat($agence->montant)}} # FBU</td>
	   		</tr>
   		@endforeach
   		
   	</tbody>
   </table>
</div>

<div class="container">
    {{-- Do your work, then step back. --}}
   {{--  <div class="form">
    	<form action="" wire:submit.prevent="saveMontantAgence">
    		<div class="form-group row">
    			<div class="col-md-4">
            <label for="" class="">AGENCE</label>
          <select name="" id="" class="form-control " wire:model="agence_id">
            <option value="">..Select </option>
            @foreach ($agences as $agence)
                         <option value="{{$agence->id}}">{{$agence->name}} </option>
            @endforeach
          </select>
          @error("agence_id")
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="col-md-4">
          <label for="" class="">MONTANT</label>
          <input type="number" wire:model="montant" class="form-control ">
          @error("montant")
          <span class="text-danger">{{$message}}</span>
          @enderror
          </div>
          <div class="col-md-3 pt-2">
            <label for="" class=""></label>
            <input type="submit" class="btn btn-info mt-4"  value="Valider">
          </div>
    		</div>
    	</form>
    </div> --}}

    <h4 class="text-center">Liste des agences</h4>
   <table class="table-sm table">
   	<thead>
   		<tr>
   			<th>#</th>
        <th>AGENCE </th>
   			<th>MONTANT</th>
   		</tr>
   	</thead>

   	<tbody>
      {{-- @dump($agences ); --}}
   		@foreach ($agences as $key=>$agence)
   			{{-- expr --}}
	   		<tr>
	   			<td>{{ ++ $key}}</td>

          <td>{{ $agence->name ?? "" }}</td>
	   			<td>{{ numberFormat($agence->montant ?? 0)}} # FBU</td>
	   		</tr>
   		@endforeach
   		 
   </table>
</div>

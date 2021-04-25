<div>
	{{-- Do your work, then step back. --}}

	<div class="row">
		<div class="col-md-4">
			@if($users)
			<label for="">Les Caissiers</label>
			<select wire:model="selectedUser" id="" class="form-control">
				<option value="">Choisissez ...</option>
				@foreach($users as $user)
				<option value="{{ $user->id }}">{{ $user->first_name.'  '. $user->last_name }}</option>
				@endforeach
			</select>
			<div class="form-group p-3 mb-2">
				<label for=""> DATE</label>
				<input type="date" wire:model="currentDate" class="form-control">
			</div>

			@endif
			
		</div>
		<div class="col-md-8">
			@if($choosedUser)
			<div class="card-header">{{ $choosedUser->first_name.' '. $choosedUser->last_name }} Le  {{ $currentDate }}</div>

			@endif

			<table class="table-sm table  table-striped table-bordered">
				<thead>
					<tr>
						<th>Versement</th>
						<th>Retrait</th>
						<th>Intérêt sur Placement</th>
						<th>Remboursement des decouverts</th>
						
					</tr>
					
				</thead>
				<tbody>
					<tr>
						<td>{{ number_format($versement) }}</td>
						<td>{{ number_format($retrait) }}</td>
						<td>{{ number_format($paiment_placement) }}</td>
						<td>{{ number_format($reboursement_decouverts) }}</td>
					</tr>
				</tbody>
			</table>
			<h4 class="text-center">IKIRIMBA</h4>

			<ul class="list-group">

				@foreach ($kirimbaOperations as $element)
					{{-- expr --}}
					<li class="list-group-item d-flex justify-content-between" >
					<h5>{{ $element->type_operation ?? ""}} : </h5>
					<h5>{{ number_format( $element->montant ?? 0) }}  FBU  </h5>

				</li>
				@endforeach
				
				
				
			</ul>		
		</div>
	</div>



</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			Nouvel depense
		</h3>
	</div>

	<div class="panel-body ">

		

		<input type="hidden" wire:model="select_id">
		<div class="input-group">
			<div class="col-md-1">
				Action 
			</div>
			<div class="col-md-3">

				<input wire:model="action_name" type="text" class="form-control input-sm">
			</div>

			<div class="col-md-1">
				Montant 
			</div>
			<div class="col-md-3">
				<input wire:model="montant" type="text" class="form-control input-sm">
			</div>
			<div class="col-md-2">
				<button type="submit" wire:click="update()" class="btn btn-primary btn-block">Modifier</button>
			</div>
			
		</div>

		
	</div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">New message</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h5 id="montant_restant"></h5>
				<form action="{{ route('reboursement-decouverts.store')}}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<fieldset class="form-group">
								<label for="compte_name">Numero du compte</label>
								<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name"  value="{{ old('compte_name') ?? $reboursementDecouvert->compte_name }}">

								{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

							</fieldset>
							<fieldset class="form-group">
								{{-- 	<label for="decouvert_id">Decouvert</label> --}}
								<input type="hidden" class="form-control {{$errors->has('decouvert_id') ? 'is-invalid' : 'is-valid' }}" id="decouvert_id" name="decouvert_id" value="{{ old('decouvert_id') ?? $reboursementDecouvert->decouvert_id }}">

								{!! $errors->first('decouvert_id', '<small class="help-block invalid-feedback">:message</small>') !!}

							</fieldset>
							
						</div>
						<div class="col-md-6">
							<fieldset class="form-group">
								<label for="date_remboursement">Date de remboursement</label>
								<input type="date" class="form-control {{$errors->has('date_remboursement') ? 'is-invalid' : 'is-valid' }}" id="date_remboursement" name="date_remboursement" value="{{ old('date_remboursement') ?? $reboursementDecouvert->date_remboursement }}">

								{!! $errors->first('date_remboursement', '<small class="help-block invalid-feedback">:message</small>') !!}

							</fieldset>
							
						</div>
						<div class="col-md-12">
							<fieldset class="form-group">
								<label for="montant">Montant</label>
								<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant" name="montant" value="{{ old('montant') ?? $reboursementDecouvert->montant }}">

								{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}

							</fieldset>

						</div>
						

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Ferme</button>
						<button type="submit" class="btn btn-primary">Enregistre</button>
					</div>
					
				</form>
			</div>
			
		</div>
	</div>
</div>





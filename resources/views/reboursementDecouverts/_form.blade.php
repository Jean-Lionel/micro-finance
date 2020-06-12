
@csrf

<div class="row offset-md-2">
	
	<div class="col-md-12">
		<h5 class="text-left">Remboursement du découvert</h5>
	</div>

	<div class="col-md-3">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $reboursementDecouvert->compte_name }}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $reboursementDecouvert->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	
	<div class="col-md-3">
		<fieldset class="form-group">
			<label for="decouvert_id">Decouvert No </label>
			<input type="text" class="form-control {{$errors->has('decouvert_id') ? 'is-invalid' : 'is-valid' }}" id="decouvert_id" name="decouvert_id" value="{{ old('decouvert_id') ?? $reboursementDecouvert->decouvert_id }}">

			{!! $errors->first('decouvert_id', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		
	</div>


</div>
























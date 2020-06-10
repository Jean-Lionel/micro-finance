
@csrf

<div class="row offset-md-2">
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistre une nouvel placement</h5>
	</div>
	<div class="col-md-3">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $placement->compte_name }}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $placement->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	<div class="col-md-3">
		
		<fieldset class="form-group">
			<label for="nbre_moi">Nombre de moi</label>
			<input type="text" class="form-control {{$errors->has('nbre_moi') ? 'is-invalid' : 'is-valid' }}" id="nbre_moi"   name="nbre_moi" value="{{ old('nbre_moi') ?? $placement->nbre_moi }}">
			{!! $errors->first('nbre_moi', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<fieldset class="form-group">
			<label for="interet_total">Interêt total en %</label>
			<input type="text" class="form-control {{$errors->has('interet_total') ? 'is-invalid' : 'is-valid' }}" id="interet_total" name="interet_total" value="{{ old('interet_total') ?? $placement->interet_total ?? 8 }}">

			{!! $errors->first('interet_total', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>
		
	</div>

	<div class="col-md-3">
		
		<fieldset class="form-group">
			<label for="date_placement">Date de placement</label>
			<input type="date" class="form-control {{$errors->has('date_placement') ? 'is-invalid' : 'is-valid' }}" id="date_placement"   name="date_placement" value="{{ old('date_placement') ?? $placement->date_placement }}">
			{!! $errors->first('date_placement', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<div class="form-group">
			<button type="submit" class="btn btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>


		
		
	</div>

	


</div>

















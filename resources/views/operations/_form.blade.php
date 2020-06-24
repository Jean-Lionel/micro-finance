
@csrf

<div class="row offset-md-2">
	
	<div class="col-md-10">
		<h5 class="text-center">Enregistre une nouvel opération</h5>
	</div>
	<div class="col-md-3">
		<fieldset class="form-group">
			<label for="compte_name">Numero du compte</label>
			<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $operation->compte_name ?? 'COO-'}}">

			{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

		</fieldset>

		<fieldset class="form-group">
			<label for="montant">Montant</label>
			<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }} number" id="montant"   name="montant" value="{{ old('montant') ?? $operation->montant }}">
			{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>
		
	</div>

	<div class="col-md-3">

		<fieldset class="form-group">
			<label for="operer_par">OPERER PAR </label>
			<input type="text" class="form-control {{$errors->has('operer_par') ? 'is-invalid' : 'is-valid' }}" id="operer_par"   name="operer_par" value="{{ old('operer_par') ?? $operation->operer_par }}">
			{!! $errors->first('operer_par', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<fieldset class="form-group">
			<label for="cni">CNI </label>
			<input type="text" class="form-control {{$errors->has('cni') ? 'is-invalid' : 'is-valid' }}" id="cni"   name="cni" value="{{ old('cni') ?? $operation->cni }}">
			{!! $errors->first('cni', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		
	</div>

	<div class="col-md-3">

		<fieldset class="form-group">
			<label for="type_operation">TYPE D'OPERATION</label>
			<select class="form-control {{$errors->has('type_operation') ? 'is-invalid' : 'is-valid' }}" id="type_operation"  name="type_operation">
				<option value="{{ old('type_operation') ?? $operation->type_operation }}">

					{{ old('type_operation') ?? $operation->type_operation ?? 'choississez une opération' }}

				</option>
				<option value="VERSEMENT">VERSEMENT</option>
				<option value="RETRAIT">RETRAIT</option>
			</select>
			{!! $errors->first('type_operation', '<small class="help-block invalid-feedback">:message</small>') !!}
		</fieldset>

		<div class="form-group">
			<button type="submit" class="btn btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			
		</div>

		
		
	</div>


</div>



















@csrf

<fieldset class="form-group">
	<label for="compte_id">compte_id</label>
	<input type="text" class="form-control {{$errors->has('compte_id') ? 'is-invalid' : 'is-valid' }}" id="compte_id" name="compte_id" value="{{ old('compte_id') ?? $operation->compte_id }}">

	{!! $errors->first('compte_id', '<small class="help-block invalid-feedback">:message</small>') !!}
	
</fieldset>

<fieldset class="form-group">
	<label for="montant">montant</label>
	<input type="text" class="form-control {{$errors->has('compte_id') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $operation->montant }}">
	{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
</fieldset>

<fieldset class="form-group">
	<label for="type_operation">TYPE D OPERATION</label>
	<select class="form-control {{$errors->has('type_operation') ? 'is-invalid' : 'is-valid' }}" id="type_operation"  name="type_operation">
		<option value="">choississez une opération</option>
		<option value="VERSEMENT">VERSEMENT</option>
		<option value="RETRAIT">RETRAIT</option>
	</select>
	{!! $errors->first('type_operation', '<small class="help-block invalid-feedback">:message</small>') !!}
</fieldset>



<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>




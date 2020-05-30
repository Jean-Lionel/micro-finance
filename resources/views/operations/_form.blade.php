

@csrf

<fieldset class="form-group">
	<label for="compte_id">compte_id</label>
	<input type="text" class="form-control" id="compte_id" name="compte_id" value="{{ old('compte_id') ?? $operation->compte_id }}">
	@error('compte_id')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</fieldset>

<fieldset class="form-group">
	<label for="montant">montant</label>
	<input type="text" class="form-control" id="montant"   name="montant" value="{{ old('montant') ?? $operation->montant }}">
</fieldset>

<fieldset class="form-group">
	<label for="type_opertation">TYPE D OPERATION</label>
	<select class="form-control" id="type_opertation"  name="type_opertation">
		<option value="+">+</option>
		<option value="-">-</option>
	</select>
</fieldset>



<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>




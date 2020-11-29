

	@csrf

	<fieldset class="form-group">
			<label for="first_name">Nom</label>
			<input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') ?? $student->first_name }}">
	</fieldset>

	<fieldset class="form-group">
			<label for="last_name">Prenom</label>
			<input type="text" class="form-control" id="last_name"   name="last_name" value="{{ old('last_name') ?? $student->last_name }}">
	</fieldset>

	<fieldset class="form-group">
		<label for="age">Age</label>
		<input type="number" class="form-control" id="age"   name="age" value="{{ old('age') ?? $student->age }}" >
	</fieldset>

	<fieldset class="form-group">
		<label for="date_naissance">Date de naissace</label>
		<input type="date" class="form-control" id="date_naissance"   name="date_naissance" value="{{ old('date_naissance') ?? $student->date_naissance  }}" >
	</fieldset>

	<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>



@csrf

<fieldset class="form-group">
	<label for="nom">Nom</label>
	<input type="text" class="form-control" id="nom" name="nom" value="{{ old('nom') ?? $client->nom }}">
	@error('nom')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</fieldset>

<fieldset class="form-group">
	<label for="prenom">Prenom</label>
	<input type="text" class="form-control" id="prenom"   name="prenom" value="{{ old('prenom') ?? $client->prenom }}">
	@error('prenom')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</fieldset>

<fieldset class="form-group">
	<label for="cni">cni</label>
	<input type="text" class="form-control" id="cni"   name="cni" value="{{ old('cni') ?? $client->cni }}" >
	@error('cni')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</fieldset>

<fieldset class="form-group">
	<label for="date_naissance">Date de naissace</label>
	<input type="date" class="form-control" id="date_naissance"   name="date_naissance" value="{{ old('date_naissance') ?? $client->date_naissance  }}" >
	@error('date_naissance')
	<div class="alert alert-danger">{{ $message }}</div>
	@enderror
</fieldset>

<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>

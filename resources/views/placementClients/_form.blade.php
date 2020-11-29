

<div class="row">

	@csrf
	<div class="col-md-12">
		<h4 class="text-center">Identification personnel</h4>


		<div class="row">

			<div class="col-md-3">
				<fieldset class="form-group ">
					<label for="nom">Nom</label>
					<input type="text" class="form-control {!! $errors->has('nom') ? 'is-invalid' : 'is-valid' !!}" id="nom" name="nom" value="{{ old('nom') ?? $client->nom }}">
					{!! $errors->first('nom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

			<div class="col-md-3">


				<fieldset class="form-group">
					<label for="prenom">Prenom</label>
					<input type="text" class="form-control  {!! $errors->has('prenom') ? 'is-invalid' : 'is-valid' !!}" id="prenom"   name="prenom" value="{{ old('prenom') ?? $client->prenom }}">
					{!! $errors->first('prenom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>
			<div class="col-md-3">
				
				<fieldset class="form-group">
					<label for="cni">cni</label>
					<input type="text" class="form-control  {!! $errors->has('cni') ? 'is-invalid' : 'is-valid' !!}" id="cni"   name="cni" value="{{ old('cni') ?? $client->cni }}" >
					{!! $errors->first('cni', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
			</div>


			<div class="col-md-3">
				
				<fieldset class="form-group">
					<label for="addresse">Addresse</label>
					<input type="text" class="form-control  {!! $errors->has('addresse') ? 'is-invalid' : 'is-valid' !!}" id="addresse"   name="addresse" value="{{ old('addresse') ?? $client->addresse }}" >
					{!! $errors->first('addresse', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
			</div>


		</div>



	</div>


	
</div>




<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>

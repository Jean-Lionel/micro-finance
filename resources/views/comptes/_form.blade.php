
@csrf

<div class="row">
	<div class="offset-md-3 col-md-9">

		<div class="form-group row">
			<label for="client_id" class="col-sm-2 col-form-label">Nom et prénom</label>
			<div class="col-sm-6">
				<input type="hidden" readonly class="form-control-plaintext" name="client_id" id="client_id" value="{{ $client->id ?? $compte->client_id }}">
				<p class="font-weight-bold">
					{{
					  $client->nom ?? $compte->client->nom
					}} 

					{{ $client->prenom ?? $compte->client->prenom }}
				 </p>
			</div>
		</div>

		<div class="form-group row">
			<label for="name" class="col-sm-2 col-form-label">Numero du compte</label>
			<div class="col-sm-4">
				<input type="text" class="form-control  {!! $errors->has('name')? 'is-invalid' : 'is-valid' !!}" name="name" id="name" value="{{ old('name') ?? $compte->name ?? 'COO-' }}">

				{!! $errors->first('name', '<small class="help-block invalid-feedback">:message</small>') !!}
			</div>
		</div>

		<div class="form-group row">
			<label for="montant" class="col-sm-2 col-form-label">Montant</label>
			<div class="col-sm-4">
				<input type="text" class="form-control {!! $errors->has('montant') ? 'is-invalid' : 'is-valid' !!}" name="montant" id="montant" value="{{ old('montant') ?? $compte->montant }}">

				{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
			</div>
		</div>

		<div class="form-group row">
			<label for="type_compte" class="col-sm-2 col-form-label">TYPE DU COMPTE</label>
			<div class="col-sm-4">
				<select name="type_compte" id="type_compte" class="form-control {!! $errors->has('type_compte') ? 'is-invalid' : 'is-valid' !!}">
					<option value="{{ old('type_compte') ?? $compte->type_compte }}" selected="">{{ old('type_compte') ?? $compte->type_compte ?? 'choisissez le type du compte' }} </option>
					<option value="COURANT"> COMPTE COURANT</option>

					<option value="EPARGNE"> COMPTE EPARGNE</option>

				</select>

				{!! $errors->first('type_compte', '<small class="help-block invalid-feedback">:message</small>') !!}
			</div>
		</div>

		<div class="form-group row">
			
			<div class="offset-sm-2 col-sm-4">
				<button type="submit" class="btn btn-outline-primary btn-block"> {{ $btnTitle}}</button>
			</div>
		</div>



		
	</div>
</div>




@extends('layouts.app')

@section('content')

<form action="{{ route('decouverts.update',$decouvert)}}" method="POST">

	@method('PUT')



	@csrf

	<div class="row">

		<div class="offset-3 col-md-6">

			<div class="col-md-12">
				<h5 class="text-center">Modification decouvert</h5>
			</div>
			<div class="col-md-12">
				<fieldset class="form-group">
					<label for="compte_name">Numero du compte</label>
					<input type="text" class="form-control {{$errors->has('compte_name') ? 'is-invalid' : 'is-valid' }}" id="compte_name" name="compte_name" value="{{ old('compte_name') ?? $decouvert->compte_name?? 'COO-' }}" disabled="true">

					{!! $errors->first('compte_name', '<small class="help-block invalid-feedback">:message</small>') !!}

				</fieldset>

				<input type="hidden" name="old_montant" value="$decouvert->montant ?? 0">

				<fieldset class="form-group">
					<label for="montant">Montant</label>
					<input type="text" class="form-control {{$errors->has('montant') ? 'is-invalid' : 'is-valid' }}" id="montant"   name="montant" value="{{ old('montant') ?? $decouvert->montant }}">
					{!! $errors->first('montant', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

			<div class="col-md-12">


				<div class="row">
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="interet">Interet </label>
							<input type="text" class="form-control {{$errors->has('interet') ? 'is-invalid' : 'is-valid' }}" id="interet" name="interet" value="{{ old('interet') ?? $decouvert->interet ?? 8 }}">

							{!! $errors->first('interet', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>

					</div>
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="periode">periode </label>
							<input type="text" class="form-control {{$errors->has('periode') ? 'is-invalid' : 'is-valid' }}" id="periode" name="periode" value="{{ old('periode') ?? $decouvert->periode ?? 3 }}">

							{!! $errors->first('periode', '<small class="help-block invalid-feedback">:message</small>') !!}

						</fieldset>
					</div>
				</div>

				<fieldset>
					<label for=""></label>
					<input type="submit" class="btn btn-outline-primary btn-block"

					value="Modifier" 
					>
				</fieldset>



			</div>


		</div>


	</div>


</form>


@endsection
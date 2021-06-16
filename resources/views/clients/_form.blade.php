

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

				<fieldset class="form-group">
					<label for="prenom">Prenom</label>
					<input type="text" class="form-control  {!! $errors->has('prenom') ? 'is-invalid' : 'is-valid' !!}" id="prenom"   name="prenom" value="{{ old('prenom') ?? $client->prenom }}">
					{!! $errors->first('prenom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="cni">cni</label>
					<input type="text" class="form-control  {!! $errors->has('cni') ? 'is-invalid' : 'is-valid' !!}" id="cni"   name="cni" value="{{ old('cni') ?? $client->cni }}" >
					{!! $errors->first('cni', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="nationalite">Nationalite</label>
					<input type="text" class="form-control  {!! $errors->has('nationalite') ? 'is-invalid' : 'is-valid' !!}" id="nationalite"   name="nationalite" value="{{ old('nationalite') ?? $client->nationalite }}" >
					{!! $errors->first('nationalite', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>
			<div class="col-md-3">


				<fieldset class="form-group">
					<label for="antenne">Antenne</label>
					<input type="text" class="form-control  {!! $errors->has('antenne') ? 'is-invalid' : 'is-valid' !!}" id="antenne"   name="antenne" value="{{ old('antenne') ?? $client->antenne }}" >
					{!! $errors->first('antenne', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="date_naissance">Date de naissace</label>
					<input type="date" class="form-control  {!! $errors->has('date_naissance') ? 'is-invalid' : 'is-valid' !!}" id="date_naissance"   name="date_naissance" value="{{ old('date_naissance') ?? $client->date_naissance  }}" >
					{!! $errors->first('date_naissance', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					
					<label for="etat_civil">ETAT CIVILE</label>

					{{-- {{ $client->etat_civil }} --}}

					<select name="etat_civil" id="etat_civil"  class="form-control {!! $errors->has('etat_civil') ? 'is-invalid' : 'is-valid'  !!}">
						<option value="{{ old('etat_civil') ?? $client->etat_civil }}" selected="">
							{{ (old('etat_civil') ?? $client->etat_civil) ?? "Choisissez l'option ici ..." }}
						</option>
						<option value="CELIBATAIRE">CELIBATAIRE</option>
						<option value="MARIE">MARIE</option>
						<option value="DIVORCE">DIVORCE</option>
						<option value="VEUF">VEUF</option>
						<option value="VEUVE">VEUVE</option>

					</select>

					{!! $errors->first('etat_civil', '<small class="help-block invalid-feedback">:message</small>') !!}

				</fieldset>

				<fieldset class="form-group">
					<label for="nom_conjoint">Nom du conjoint</label>
					<input type="text" class="form-control  {!! $errors->has('nom_conjoint') ? 'is-invalid' : 'is-valid' !!}" id="nom_conjoint"   name="nom_conjoint" value="{{ old('nom_conjoint') ?? $client->nom_conjoint  }}" >
					{!! $errors->first('nom_conjoint', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				
			</div>
			<div class="col-md-3">

				<fieldset class="form-group">
					<label for="profession">Profession</label>
					<input type="text" class="form-control  {!! $errors->has('profession') ? 'is-invalid' : 'is-valid' !!}" id="profession"   name="profession" value="{{ old('profession') ?? $client->profession  }}" >
					{!! $errors->first('profession', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="nom_employeur">NOM DE L'EMPLOYEUR</label>
					<input type="text" class="form-control  {!! $errors->has('nom_employeur') ? 'is-invalid' : 'is-valid' !!}" id="nom_employeur"   name="nom_employeur" value="{{ old('nom_employeur') ?? $client->nom_employeur  }}" >
					{!! $errors->first('nom_employeur', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="lieu_activite">LIEU D'ACTIVITE</label>
					<input type="text" class="form-control  {!! $errors->has('lieu_activite') ? 'is-invalid' : 'is-valid' !!}" id="lieu_activite"   name="lieu_activite" value="{{ old('lieu_activite') ?? $client->lieu_activite  }}" >
					{!! $errors->first('lieu_activite', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="address_no">ADDRESSE NO </label>
					<input type="text" class="form-control  {!! $errors->has('address_no') ? 'is-invalid' : 'is-valid' !!}" id="address_no"   name="address_no" value="{{ old('address_no') ?? $client->address_no  }}" >
					{!! $errors->first('address_no', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
			</div>
			<div class="col-md-3">


				<fieldset class="form-group">
					<label for="commune">Comunne</label>
					<input type="text" class="form-control  {!! $errors->has('commune') ? 'is-invalid' : 'is-valid' !!}" id="commune"   name="commune" value="{{ old('commune') ?? $client->commune  }}" >
					{!! $errors->first('commune', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="quartier">Quartier</label>
					<input type="text" class="form-control  {!! $errors->has('quartier') ? 'is-invalid' : 'is-valid' !!}" id="quartier"   name="quartier" value="{{ old('quartier') ?? $client->quartier  }}" >
					{!! $errors->first('quartier', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				
				<div class="row">
					
					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="rue">rue</label>
							<input type="text" class="form-control  {!! $errors->has('rue') ? 'is-invalid' : 'is-valid' !!}" id="rue"   name="rue" value="{{ old('rue') ?? $client->rue  }}" >
							{!! $errors->first('rue', '<small class="help-block invalid-feedback">:message</small>') !!}
						</fieldset>
						
					</div>

					<div class="col-md-6">
						<fieldset class="form-group">
							<label for="boite_postal">B.P</label>
							<input type="text" class="form-control  {!! $errors->has('boite_postal') ? 'is-invalid' : 'is-valid' !!}" id="boite_postal"   name="boite_postal" value="{{ old('boite_postal') ?? $client->boite_postal  }}" >
							{!! $errors->first('boite_postal', '<small class="help-block invalid-feedback">:message</small>') !!}
						</fieldset>
						
					</div>
				</div>

				<fieldset class="form-group">
					<label for="telephone">Telephone</label>
					<input type="text" class="form-control  {!! $errors->has('telephone') ? 'is-invalid' : 'is-valid' !!}" id="telephone"   name="telephone" value="{{ old('telephone') ?? $client->telephone  }}" >
					{!! $errors->first('telephone', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

		</div>



	</div>

	<div class="col-md-12">
		<h5 class="text-center">Noms et Prénoms des signataires</h5>

		<div class="row">

			<div class="col-md-4">
				<h4>Signateur No 1</h4>

				<fieldset class="form-group">
					<label for="signateur_1_nom_prenom">Nom et prénom</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_1_nom_prenom') ? 'is-invalid' : 'is-valid' !!}" id="signateur_1_nom_prenom"   name="signateur_1_nom_prenom" value="{{ old('signateur_1_nom_prenom') ?? $client->signateur_1_nom_prenom  }}" >
					{!! $errors->first('signateur_1_nom_prenom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="signateur_1_cni">C.N.I</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_1_cni') ? 'is-invalid' : 'is-valid' !!}" id="signateur_1_cni"   name="signateur_1_cni" value="{{ old('signateur_1_cni') ?? $client->signateur_1_cni  }}" >
					{!! $errors->first('signateur_1_cni', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="signateur_1_tel">Telephone</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_1_tel') ? 'is-invalid' : 'is-valid' !!}" id="signateur_1_tel"   name="signateur_1_tel" value="{{ old('signateur_1_tel') ?? $client->signateur_1_tel  }}" >
					{!! $errors->first('signateur_1_tel', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

			<div class="col-md-4">
				<h4>Signateur No 2</h4>

				<fieldset class="form-group">
					<label for="signateur_2_nom_prenom">Nom et prénom</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_2_nom_prenom') ? 'is-invalid' : 'is-valid' !!}" id="signateur_2_nom_prenom"   name="signateur_2_nom_prenom" value="{{ old('signateur_2_nom_prenom') ?? $client->signateur_2_nom_prenom  }}" >
					{!! $errors->first('signateur_2_nom_prenom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="signateur_2_cni">C.N.I</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_2_cni') ? 'is-invalid' : 'is-valid' !!}" id="signateur_2_cni"   name="signateur_2_cni" value="{{ old('signateur_2_cni') ?? $client->signateur_2_cni  }}" >
					{!! $errors->first('signateur_2_cni', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="signateur_2_tel">Telephone</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_2_tel') ? 'is-invalid' : 'is-valid' !!}" id="signateur_2_tel"   name="signateur_2_tel" value="{{ old('signateur_2_tel') ?? $client->signateur_2_tel  }}" >
					{!! $errors->first('signateur_2_tel', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

			<div class="col-md-4">
				<h4>Signateur No 3</h4>

				<fieldset class="form-group">
					<label for="signateur_3_nom_prenom">Nom et prénom</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_3_nom_prenom') ? 'is-invalid' : 'is-valid' !!}" id="signateur_3_nom_prenom"   name="signateur_3_nom_prenom" value="{{ old('signateur_3_nom_prenom') ?? $client->signateur_3_nom_prenom  }}" >
					{!! $errors->first('signateur_3_nom_prenom', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>
				<fieldset class="form-group">
					<label for="signateur_3_cni">C.N.I</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_3_cni') ? 'is-invalid' : 'is-valid' !!}" id="signateur_3_cni"   name="signateur_3_cni" value="{{ old('signateur_3_cni') ?? $client->signateur_3_cni  }}" >
					{!! $errors->first('signateur_3_cni', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

				<fieldset class="form-group">
					<label for="signateur_3_tel">Telephone</label>
					<input type="text" class="form-control  {!! $errors->has('signateur_3_tel') ? 'is-invalid' : 'is-valid' !!}" id="signateur_3_tel"   name="signateur_3_tel" value="{{ old('signateur_3_tel') ?? $client->signateur_3_tel  }}" >
					{!! $errors->first('signateur_3_tel', '<small class="help-block invalid-feedback">:message</small>') !!}
				</fieldset>

			</div>

			<div class="col-md-12 mt-4">
				<div class="form-group">
					<label for="upload_image">Ajouter une photo</label>
					<input type="file" name="upload_image" class="form-control-file" id="upload_image">
				</div>
			</div>

		</div>
	</div>

	
</div>







<button type="submit" class="btn btn-outline-primary"> {{ $btnTitle}}</button>

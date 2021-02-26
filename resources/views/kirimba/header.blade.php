<div class="row  mt-0 mb-2 offset-2">
		<div class="col">
			<a href="{{ route('ikirimba-operation') }}">opération</a>
		</div>
		<div class="col">
			<a href="{{ route('ikirimba-membre') }}"> Membres</a>
		</div>
		<div class="col">
			<a href="{{ route('ikirimba-history') }}"> Historique des opérations</a>
		</div>
		@can('is-admin')
		<div class="col"> <a href="{{ route('ikirimba-rapport') }}">Rapport</a> </div>
		@endcan
</div>
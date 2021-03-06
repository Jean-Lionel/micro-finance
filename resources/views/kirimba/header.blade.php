<div class="row  mt-0 mb-2 offset-2">
		<div class="col">
			<a href="{{ route('ikirimba-operation') }}" class="{{set_active_router('ikirimba-operation')}}">opération</a>
		</div>
		<div class="col">
			<a href="{{ route('ikirimba-membre') }}" class="{{set_active_router('ikirimba-membre')}}"> Membres</a>
		</div>
		<div class="col">
			<a href="{{ route('ikirimba-history') }}" class="{{set_active_router('ikirimba-history')}}"> Historique des opérations</a>
		</div>
		@can('is-admin')
		<div class="col"> <a href="{{ route('ikirimba-rapport') }}" class="{{set_active_router('ikirimba-rapport')}}">Rapport</a> </div>

		<div class="col"> <a href="{{ route('kirimba-rapport-dette') }}" class="{{set_active_router('kirimba-rapport-dette')}}">Rapport des dettes</a> </div>
		@endcan
</div>
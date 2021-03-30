@extends('layouts.app')


@can('is-admin')
    {{-- expr --}}


@section('content')

<div class="row text-center">
	<div class="col-md-12 row">
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
	
		
	</div>
	
	
	<div class="col-md-12 col-sm-12">
		@livewire('general-chart')
		
	</div>

</div>

@endsection

@endcan


@extends('layouts.app')


@can('is-admin')
    {{-- expr --}}


@section('content')

<div class="text-center">
	
	@livewire('chart-compte-principal')
	<div class="col-md-12 col-sm-12">
		@livewire('general-chart')	
	</div>

</div>

@endsection

@endcan


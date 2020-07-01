@extends('layouts.app')

@section('content')
	{{-- expr --}}
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				{{-- @livewire('depenses.depense-component') --}}

				 @livewire('depense-component')
			</div>
		</div>
	</div>
@endsection
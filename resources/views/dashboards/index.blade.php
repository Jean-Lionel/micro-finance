@extends('layouts.app')


@can('is-admin')
    {{-- expr --}}


@section('content')

<div class="row text-center">
	<div class="col-md-12 row">
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
		{{-- <div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div>
		<div class="col-sm-6 col-md-3">
			@livewire('chart-compte-principal')
		</div> --}}
		
		{{-- <div class="col-sm-6 col-md-3">
			<div class="col-md">
				<div class="card text-center text-white  mb-3" id="total-orders" style="background-color: #4cb4c7;">
					<div class="card-header">
						<h5 class="card-title">Total Orders</h5>
					</div>
					<div class="card-body">
						<h3 class="card-title">0</h3>
					</div>
				</div>
			</div>
		</div> --}}
		
	</div>
	
	
	<div class="col-md-12 col-sm-12">
		@livewire('general-chart')
		
	</div>

</div>

@endsection

@endcan


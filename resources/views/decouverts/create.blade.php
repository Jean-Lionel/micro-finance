@extends('layouts.app')

@section('content')


<div class="row">

	<div class="col-md-6">
		<form action="{{ route('decouverts.store')}}" method="POST">

			@include('decouverts._form',['btnTitle' => 'Enregistre'])

		</form>
	</div>

	<div class="col-md-6 client-info">
		
	</div>
	
</div>


@endsection
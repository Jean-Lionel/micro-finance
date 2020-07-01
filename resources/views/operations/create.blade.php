@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<form action="{{ route('operations.store')}}" method="POST">

			@include('operations._form',['btnTitle' => 'Enregistre'])

		</form>
	</div>

	<div class="col-md-6 client-info">
	
	</div>

</div>


@endsection



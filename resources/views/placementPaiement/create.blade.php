@extends('layouts.app')

@section('content')



<div class="row">
	<div class="col-md-4">
		<form action="{{ route('placementPaiement.store') }}" method="POST">

			@method('POST')

	@include('placementPaiement._form',['btnTitle' => 'Enregistrer'])
		</form>
		
	</div>
	<div class="col-md-8 client-placement">
		
	</div>
	<div class="offset-md-4  col-md-8 client-info">	
	</div>

	
</div>

@endsection
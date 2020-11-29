@extends('layouts.app')

@section('content')



<div class="row">
	<div class="col-md-6">
		<form action="{{ route('placementPaiement.store') }}" method="POST">

			@method('POST')

	@include('placementPaiement._form',['btnTitle' => 'Enregistrer'])
		</form>
		
	</div>
	<div class="col-md-6 client-info">
		
	</div>
</div>

@endsection
@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-4">
		<div id="form_id">
			@include('operations._form',['btnTitle' => 'Enregistrer'])
		</div>
	</div>
	<div class="col-md-8 client-info">
	</div>
</div>

@endsection



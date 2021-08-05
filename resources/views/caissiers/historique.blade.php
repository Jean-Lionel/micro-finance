@extends('layouts.app')
@section('content')
<div>
	@livewire('historique-caissier', ['post' => $post])
</div>
@endsection
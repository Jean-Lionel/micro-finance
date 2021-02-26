@extends('layouts.app')

@section('content')

<div>
	@include('kirimba.header')
	<livewire:kirimba-operation-history />
</div>

@endsection
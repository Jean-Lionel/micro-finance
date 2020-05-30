@extends('layouts.app')

@section('content')

<form action="{{ route('clients.store')}}" method="POST">

@include('clients._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
@extends('layouts.app')

@section('content')

<form action="{{ route('decouverts.store')}}" method="POST">

@include('decouverts._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
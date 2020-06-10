@extends('layouts.app')

@section('content')

<form action="{{ route('decouverts.update',$decouvert)}}" method="POST">

@method('PUT')
@include('decouverts._form',['btnTitle' => 'Modifier'])



</form>


@endsection
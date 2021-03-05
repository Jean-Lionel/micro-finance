@extends('layouts.app')

@section('content')

<form action="{{ route('comptes.update',$compte)}}" method="POST">

@method('PUT')
@include('comptes._form',['btnTitle' => 'Modifier'])



</form>


@endsection
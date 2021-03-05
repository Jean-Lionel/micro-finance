@extends('layouts.app')

@section('content')

<form action="{{ route('operations.update',$operation)}}" method="POST">

@method('PUT')
@include('operations._form',['btnTitle' => 'Modifier'])



</form>


@endsection
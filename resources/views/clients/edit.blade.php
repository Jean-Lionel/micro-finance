@extends('layouts.app')

@section('content')

<form action="{{ route('clients.update',$client)}}" method="POST" enctype="multipart/form-data">

@method('PUT')

@include('clients._form',['btnTitle' => 'Modifier'])

</form>


@endsection
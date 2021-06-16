@extends('layouts.app')

@section('content')

<form action="{{ route('clients.store')}}" method="POST" enctype="multipart/form-data">

@include('clients._form',['btnTitle' => 'Enregistrer'])

</form>


@endsection
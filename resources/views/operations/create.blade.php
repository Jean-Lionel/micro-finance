@extends('layouts.app')

@section('content')

<form action="{{ route('operations.store')}}" method="POST">

@include('operations._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
@extends('layouts.app')

@section('content')

<form action="{{ route('placements.store')}}" method="POST">

@include('placements._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
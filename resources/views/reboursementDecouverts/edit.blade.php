@extends('layouts.app')

@section('content')

<form action="{{ route('reboursement-decouverts.update',$decouvert)}}" method="POST">

@method('PUT')
@include('reboursementDecouverts._form',['btnTitle' => 'Modifier'])



</form>


@endsection
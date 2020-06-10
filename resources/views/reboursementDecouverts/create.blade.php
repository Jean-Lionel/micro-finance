@extends('layouts.app')

@section('content')

<form action="{{ route('reboursement-decouverts.store')}}" method="POST">

@include('reboursementDecouverts._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
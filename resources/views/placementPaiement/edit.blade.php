@extends('layouts.app')

@section('content')

<form action="{{ route('placements.update',$placement_paiment)}}" method="POST">

@method('PUT')
@include('placements._form',['btnTitle' => 'Modifier'])

</form>
@endsection
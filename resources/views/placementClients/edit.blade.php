@extends('layouts.app')

@section('content')

<form action="{{ route('placement-client.update',$client)}}" method="POST" enctype="multipart/form-data">

@method('PUT')

@include('placementClients._form',['btnTitle' => 'Modifier'])

</form>


@endsection
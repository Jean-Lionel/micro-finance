@extends('layouts.app')

@section('content')

<form action="{{ route('placement-client.store')}}" method="POST" enctype="multipart/form-data">

@include('placementClients._form',['btnTitle' => 'Enregistrer'])

</form>


@endsection
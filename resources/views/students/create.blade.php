@extends('layouts.app')

@section('content')

<form action="{{ route('student.store')}}" method="POST">

@include('students._form',['btnTitle' => 'Enregistre'])

</form>


@endsection
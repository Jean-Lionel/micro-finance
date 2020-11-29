@extends('layouts.app')

@section('content')

<form action="{{ route('student.update',$student)}}" method="POST">

@method('PUT')
@include('students._form',['btnTitle' => 'Modifier'])



</form>


@endsection
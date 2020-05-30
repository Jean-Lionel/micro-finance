@extends('layouts.app')

@section('content')

<div class="card" style="width: 40rem;">
  <div class="card-header">
    INformation complet
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nom : <b>{{ $student->first_name}} </b></li>
    <li class="list-group-item">Prenom : <b>{{ $student->last_name}} </b></li>
    <li class="list-group-item">Age : <b>{{ $student->age}} </b></li>
    <li class="list-group-item">Date de naissance : <b>{{ $student->date_naissance}} </b></li>
    
  </ul>
</div>

@endsection
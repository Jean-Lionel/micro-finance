@extends('layouts.app')

@section('content')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header text-center">
                  
                <div class="row">
                    <div class="col-md-4">
                          <a href="{{ route('users.create') }}" class="btn btn-info btn-sm">Nouvel utilisateur</a>
                    </div>
                    <div class="col-md-4">
                          <a href="{{ route('agences') }}" class="btn btn-info btn-sm">Agence</a>
                    </div>

                    <div class="col-md-4">
                        {{ __('Liste des utilisateurs') }}
                    </div>  
                    <div class="col-md-4">
                        <form action="">
                            <input type="text" name="search" value="{{$search ?? '' }}" placeholder="Rechercher ici ...." class="form-control">
                        </form>
                    </div>
                </div>

                </div>

                <div class="card-body">
                	
                    <table class="table">
                        <thead>

                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Prénom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>

                                <th scope="col">Action</th>
                            </tr>
                            
                        </thead>

                        <tbody>

                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>

                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td> {{ $user->email }}</td>

                                <td>
                                  {{--   {{ implode(',', $user->roles()->get()->pluck('name')->toArray())}} --}}

                                    <ul class="list-group-item-info">

                                        @foreach($user->roles()->get() as $role)
                                        <li>
                                            {{ $role->name }}
                                        </li>
                                        
                                          @endforeach
                                    </ul>
                                    
                                </td>
                                <td>
                                    
                                    <a href="{{ route('users.edit', $user) }}"> <button class="btn btn-primary" >Editer</button></a>

                                    @can('destroy-user')
                                        {{-- expr --}}

                                         <a href=" {{ route('users.destroy', $user) }}"> <button class="btn btn-warning" >Supprimer</button></a>
                                    @endcan

                                    
                                </td>

                            </tr>

                            @endforeach
                            
                        </tbody>
                    </table>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@stop
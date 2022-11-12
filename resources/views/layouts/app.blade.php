<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>	COOPDI  | MANAGER</title>



  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">


  <link rel="stylesheet" href="{{ asset('font-awesome/css/all.min.css') }}">

  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href= "{{ asset('css/decouvert_form.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('css/print.min.css') }}">

   <link rel="stylesheet" type="text/css" href="{{ asset('datatable/css/datatables.min.css') }}" defer>

  <style>

  </style>

  @livewireStyles

  <style> 
    .active{
      background: rgba(255,255,255,0.5);
      color: #000;
    }
    #nav-bar a,nav a,.white-color{
      text-decoration: none;
      color: white;
      font-family: "Fira Code";
    }

    #nav-bar{
      /*background: #027368;*/

      background: #5b8c85;
      font-size: 12px;
      font-family: sans-serif;
      /*background: #f66d9b;*/ 
      
    }
    .table td, table th{
      padding: 0px;
    }
    body{

      /*background: rgba(138, 138, 138,0.3);*/
      background: #ebeff5;

      /*font-size: 12px;*/

      /*background: #434e52;*/
      
      /*background: #6cb2eb;*/
      /*opacity: 0.5;*/
      /*background: rgba(167,200,242,1);*/
    }
  </style>
</head>
<body>


	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 border-bottom box-shadow" id="nav-bar" >
    <h5 class="my-0 mr-md-auto font-weight-normal {{set_active_router('home')}}"><a href="{{ route('home')}}">
      <i class="fa fa-home"></i> COOPDI BURUNDI</a></h5>
      <nav class="my-2 my-md-0 mr-md-3">

       <a class="p-2  {{set_active_router('operations.index')}}" href="{{ route('operations.index') }}"><i class="fa fa-expand"></i> Operation</a>

       @can('is-register-client')

       @cannot('is-admin')

       <a class="p-2  {{set_active_router('clients.index')}}" href="{{ route('clients.index') }}"><i class="fa fa-wheelchair-alt"></i> Client</a>

       @endcannot

       @endcan
       @canany(['placement-manager','is-placement'])
       @cannot('is-admin')
       <a class="p-2 {{set_active_router('placements.index')}}" href="{{ route('placements.index') }}"><i class="fa fa-inbox"></i> Placement</a>
       @endcannot

       @endcanany



       @can('decouvert-manager')

       @cannot('is-admin')

       <a class="p-2 {{set_active_router('decouverts.index')}}" href="{{ route('decouverts.index') }}"><i class="fa fa-tint"></i> Decouvert</a>

       @endcannot

       @endcan

       @can('is-admin')
       {{-- expr --}}


       <a class="p-2  {{set_active_router('clients.index')}}" href="{{ route('clients.index') }}"><i class="fa fa-wheelchair-alt"></i> Client</a>
       
       <a class="p-2 {{set_active_router('comptes.index')}}" href="{{ route('comptes.index') }}"><i class="fa fa-book"></i> Situation</a>
       <a class="p-2 {{set_active_router('placements.index')}}" href="{{ route('placements.index') }}"><i class="fa fa-inbox"></i> Placement</a>
       <a class="p-2 {{set_active_router('decouverts.index')}}" href="{{ route('decouverts.index') }}"><i class="fa fa-tint"></i> Decouvert</a>
       

       <a class="p-2 {{set_active_router('rapports')}}" href="{{ route('rapports.index') }}"><i class="fa fa-share"></i> Rapport</a>
        {{-- <a class="p-2 {{set_active_router('rapports')}}" href="{{ route('placement-client.index') }}"><i class="fa fa-share"></i>Compte des place</a>
        --}}


        <a class="p-2 {{set_active_router('register')}}"  href="{{ route('users.index') }}"><i class="fa fa-users"></i> Utilisateur</a>
        @endcan

        <a  class="p-2 {{set_active_router('ikirimba-membre')}}" href="{{ route('ikirimba-membre') }}">Epargnes</a>


      </nav>
      {{-- <a class="btn btn-outline-primary" href="#">Deconnexion</a> --}}

      <li class="nav-item dropdown" style="list-style: none;">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
         <i class="fa fa-user"></i> {{ Auth::user()->full_name }} <span class="caret"></span>
       </a>

       <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item text-dark" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fa fa-power-off"></i> {{ __(' Logout') }}
        
      </a>

      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </li>

</div>

<div class="container-fluid">

  @yield('content')
</div>

<script src="{{ asset('jquery-3.5.1.min.js') }}"></script>

<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<script src="{{ asset('js/Chart.bundle.min.js') }}"></script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/print.min.js') }}"></script>

<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/nombre_en_lettre.js') }}"></script>

<script src="{{ asset('datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('datatable/datatables.min.js') }}"></script>
@yield('javascript')
@livewireScripts

@include('flashy::message')

@stack('scripts')

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>	Coopedi Manager</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>
 @livewireStyles
<style> 
  .active{
    background: rgba(255,45,255,0.5);
    color: red;
  }
  a{
    text-decoration-color: none;
  }
</style>

</head>
<body>

	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal {{set_active_router('home')}}"><a href="{{ route('home')}}">
      <i class="fa fa-home"></i> COOPDI BURUNDI</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">

      <a class="p-2 text-dark  {{set_active_router('clients.index')}}" href="{{ route('clients.index') }}"><i class="fa fa-wheelchair-alt"></i>Client</a>
      <a class="p-2 text-dark  {{set_active_router('operations.index')}}" href="{{ route('operations.index') }}"><i class="fa fa-expand"></i>Operation</a>
      <a class="p-2 text-dark {{set_active_router('comptes.index')}}" href="{{ route('comptes.index') }}"><i class="fa fa-book"></i>compte</a>
      <a class="p-2 text-dark {{set_active_router('placements.index')}}" href="{{ route('placements.index') }}"><i class="fa fa-inbox"></i>Placement</a>
      <a class="p-2 text-dark {{set_active_router('decouverts.index')}}" href="{{ route('decouverts.index') }}"><i class="fa fa-tint"></i>Decouvert</a>
      <a class="p-2 text-dark {{set_active_router('reboursement-decouverts.index')}}" href="{{ route('reboursement-decouverts.index') }}"><i class="fa fa-share"></i>Remboursement</a>
    </nav>
    {{-- <a class="btn btn-outline-primary" href="#">Deconnexion</a> --}}
    
    <li class="nav-item dropdown" style="list-style: none;">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                               <i class="fa fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>{{ __('Logout') }}
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

  <script src="/js/jquery-3.5.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
  @livewireScripts
  @yield('javascript')
  
  @include('flashy::message')

   @livewireScripts
  @stack('scripts')
  
</body>
</html>
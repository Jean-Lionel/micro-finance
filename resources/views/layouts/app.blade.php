<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>	Copedi Manager</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700' rel='stylesheet'>

</head>
<body>

	<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="{{ route('clients.index')}}">COPDI BURUNDI</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="{{ route('clients.index') }}">CLIENT</a>
      <a class="p-2 text-dark" href="{{ route('operations.index') }}">Operation</a>
      <a class="p-2 text-dark" href="{{ route('comptes.index') }}">compte</a>
      <a class="p-2 text-dark" href="{{ route('placements.index') }}">Placement</a>
      <a class="p-2 text-dark" href="{{ route('decouverts.index') }}">Decouvert</a>
      <a class="p-2 text-dark" href="{{ route('reboursement-decouverts.index') }}">Remboursement</a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Deconnexion</a>
  </div>

  <div class="container-fluid">
   
    @yield('content')
  </div>

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
</body>
</html>
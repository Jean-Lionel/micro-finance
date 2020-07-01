@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-1 col-sm-12">
		<p><a href="{{ route('operations.create')}}" class="text-lg-center white-color">Versement</a></p>
		<p><a href="{{ route('operations.create')}}" class="text-lg-center white-color">Retrait</a></p>
		
	</div>
	<div class="col-md-10 col-sm-12">
		


		<div class="row">
			<div class="col-md-8">

				<p class="text-center">Tout les opérations</p>	
			</div>
			<div class="col-md-4 col-sm-6">
				<form action="" class="navbar-form navbar-left">
					<div class="input-group custom-search-form">
						<input type="text" class="form-control" name="search" placeholder="Search..." value="{{$search}}">
						<span class="input-group-btn">
							<button class="btn btn-default-sm" type="submit">
								<i class="fa fa-search"></i>
							</button>
						</span>

					</div>
				</form>
			</div>
		</div>



		@if($operations)

		<table class="table table-bordered table-sm table-inverse table-hover">
			<thead>
				<tr>
					<th>No</th>
					<th>@sortablelink('compte_name','COMPTE NO')</th>
					<th>@sortablelink('montant','Montant') </th>
					<th>@sortablelink('type_operation','Type d\' operation')</th>
					<th>@sortablelink('created_at','Date') </th>


					<th>Action</th>
				</tr>
			</thead>
			<tbody>

				@foreach($operations as $key=> $operation)
				<tr>
					<td>{{$key + 1}}</td>
					<td>{{ $operation->compte_name}}</td>
					<td>{{ numberFormat($operation->montant)}}</td>
					<td>{{ $operation->type_operation}}</td>
					<td>{{ $operation->created_at}}</td>
					<td>
						<!-- <a href="{{ route('operations.show',$operation) }}" class="btn btn-outline-info">show</a> -->
						<a href="{{ route('operations.edit',$operation) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

						<form action="{{ route('operations.destroy' , $operation) }}" style="display: inline;" method="POST">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<button class="btn btn-outline-danger btn-sm">Delete</button>
						</form>


					</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		{{ $operations->links()}}


		@endif


	</div>
</div>




@endsection
 @extends('layouts.app')

@section('content')
<h1>Listes des élèves disponible</h1>

<a href="{{ route('student.create')}}" class="btn btn-info">Ajouter une nouvelle élève</a>

@if($students)

<table class="table table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>@sortablelink('first_name','Nom')</th>
			<th>@sortablelink('last_name','Prénom') </th>
			<th>@sortablelink('age','Age')</th>
			<th>@sortablelink('date_naissance','Date de naissance')</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($students as $student)
		<tr>
			<td>{{ $student->first_name}}</td>
			<td>{{ $student->last_name}}</td>
			<td>{{ $student->age}}</td>
			<td>{{ $student->date_naissance}}</td>
			<td>
				<a href="{{ route('student.show',$student) }}" class="btn btn-outline-info">show</a>
				<a href="{{ route('student.edit',$student) }}" class="btn btn-outline-dark">Modicier</a>
			
					<form action="{{ route('student.destroy' , $student) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger">Delete</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $students->links()}}


@endif



@endsection
<!DOCTYPE html>
<html>
<head>
	<title>Hi</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
	<h1>Je suis un future ingenieur en informatique - {{ $title }}</h1>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

	<style>

		table, td, th,tr{
			border-collapse: collapse; 
			border: 1px solid black
		}
		
	</style>

	<table>
		<thead>
			<tr>
				<th>NOM</th>
				<th>PRENOM</th>
				<th>AGE</th>
				<th>NATIONALITE</th>
			</tr>
		</thead>

		<tbody>
			@for ($i = 0; $i < 100; $i++)
				<tr>
					<td>{{$i}}</td>
					<td>{{$i}}</td>
					<td>{{$i}}</td>
					<td>{{$i}}</td>
					
				</tr>
			@endfor
		</tbody>
	</table>


</body>
</html>
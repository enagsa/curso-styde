@extends('layout')

@section('title', 'Listado de Usuarios')

@section('content')
	<h1>{{ $title }}</h1>
	<hr/>

	@unless(empty($users))
		<ul>
			@foreach($users as $user)
				<li>{{ $user }}</li>
			@endforeach
		</ul>
	@else
		<p>No hay usuarios registrados</p>
	@endif	
@endsection

@section('sidebar')
	@parent
	<h3>Barra Lateral personalizada</h3>
@endsection
@extends('layout')

@section('title', 'Crear usuario')

@section('content')
	<h1>Crear usuario</h1>

	<form method="POST" action="{{ route('users.store') }}">
		{{ csrf_field() }}
		<button type="submit">Crear usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>
@endsection
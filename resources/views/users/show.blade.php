@extends('layout')

@section('title', "Usuario #{$user->id}")

@section('content')
	<h1>Usuario #{{ $user->id }}</h1>
	<p>Nombre: {{ $user->name }}</p>
	<p>Nombre: {{ $user->email }}</p>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>
@endsection
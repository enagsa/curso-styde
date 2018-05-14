@extends('layout')

@section('title', "Usuario {$id}")

@section('content')
	<h1>Usuario {{ $id }}</h1>
	Monstrando detalle del usuario: {{ $id }}
@endsection
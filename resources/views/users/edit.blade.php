@extends('layout')

@section('title', 'Editar usuario')

@section('content')
	<h1>Editar usuario</h1>

	@if($errors->any())
		<div class="alert alert-danger">
			<h4>Por favor corrige los errores:</h4>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<form method="POST" action="{{ route('users.update', $user) }}">
		{{ method_field('PUT') }}
		{{ csrf_field() }}

		<label for="name">Nombre</label>
		<input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Enrique Aguilar" />
		<br/>

		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="prueba@prueba.es" />
		<br/>

		<label for="password">Contraseña</label>
		<input type="password" name="password" id="password" placeholder="Mínimo 5 caracteres" />
		<br/>

		<button type="submit">Actualizar usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>
@endsection
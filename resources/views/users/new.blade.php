@extends('layout')

@section('title', 'Crear usuario')

@section('content')
	<h1>Crear usuario</h1>

	@if($errors->any())
		<div class="alert alert-danger">
			<h4>Por favor corrige los errores:</h4>
			{{--<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>--}}
		</div>
	@endif

	<form method="POST" action="{{ route('users.store') }}">
		{{ csrf_field() }}

		<label for="name">Nombre</label>
		<input type="text" name="name" id="name" value="{{ old('name') }}"/>
		@if($errors->has('name'))
			<p>{{ $errors->first('name') }}</p>
		@endif
		<br/>

		<label for="email">Email</label>
		<input type="email" name="email" id="email" value="{{ old('email') }}"/>
		@if($errors->has('email'))
			<p>{{ $errors->first('email') }}</p>
		@endif
		<br/>

		<label for="password">Contraseña</label>
		<input type="password" name="password" id="password"/>
		<br/>

		<button type="submit">Crear usuario</button>
	</form>

	<p><a href="{{ route('users') }}">Volver al listado</a></p>
@endsection
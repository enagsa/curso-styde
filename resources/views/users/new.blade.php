@extends('layout')

@section('title', 'Crear usuario')

@section('content')
	<div class="card">
		<h3 class="card-header">Crear usuario</h3>
		<div class="card-body">

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

			<form method="POST" action="{{ route('users.store') }}">
				{{ csrf_field() }}

				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Enrique Aguilar" />
				</div>

				
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="prueba@prueba.es" />
				</div>
				<div class="form-group">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Mínimo 5 caracteres" />
				</div>

				<button type="submit" class="btn btn-primary">Crear usuario</button>
				<a href="{{ route('users') }}" class="btn btn-link">Volver al listado</a>
			</form>
		</div>
	</div>

@endsection
@extends('admin.template.main')

@section('title', 'Editar usuario ' . $user->name)

@section('content')

	{!! Form::open(['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Nombre Completo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('username', 'Usuario') !!}
		{!! Form::text('username', $user->username, ['class' => 'form-control', 'placeholder' => 'Nombre de uruario','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Correo Electronico') !!}
		{!! Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('type', 'Tipo de usuario') !!}
		{!! Form::select('type', ['member' => 'Miembro', 'admin' => 'Administrador'], $user->type, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Editar', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
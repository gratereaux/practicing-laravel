@extends('admin.template.main')

@section('title', 'Agregar nuevo usuarios')

@section('content')

	@include ('errors.list')

	{!! Form::open(['route' => 'admin.auth.register', 'method' => 'POST']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('username', 'Usuario') !!}
		{!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Nombre de uruario','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('email', 'Correo Electronico') !!}
		{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'ejemplo@gmail.com','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('password', 'Contraseña') !!}
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '**********','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::select('type', ['member' => 'Miembro'], null, ['class' => 'form-control', 'required']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
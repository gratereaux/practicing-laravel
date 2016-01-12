@extends('admin.template.main')

@section('title', 'Agregar nuevo usuarios')

@section('content')

	{!! Form::open(['route' => 'admin.users.store', 'method' => 'POST']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre Completo','required']) !!}
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
		{!! Form::label('type', 'Tipo de usuario') !!}
		{!! Form::select('type', [''=>'Seleccione', 'member' => 'Miembro', 'admin' => 'Administrador'], null, ['class' => 'form-control']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Registrar', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
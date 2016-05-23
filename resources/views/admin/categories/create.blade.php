@extends('admin.template.main')

@section('title', 'Agregar nueva categoría')

@section('content')

	@include ('errors.list')

	{!! Form::open(['route' => 'admin.categories.store', 'method' => 'POST']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de Categoría','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Crear categoría', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
@extends('admin.template.main')

@section('title', 'Editar Tags '. $tag->name)

@section('content')

	@include ('errors.list')

	{!! Form::open(['route' => ['admin.tags.update', $tag], 'method' => 'PUT']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', $tag->name, ['class' => 'form-control', 'placeholder' => 'Nombre del Tag','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Editar tag', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
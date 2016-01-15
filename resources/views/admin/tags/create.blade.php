@extends('admin.template.main')

@section('title', 'Agregar nuevo tag')

@section('content')

	@if (count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach($errors->all() as $error)
				 	<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	{!! Form::open(['route' => 'admin.tags.store', 'method' => 'POST']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del Tag','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Crear Tag', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
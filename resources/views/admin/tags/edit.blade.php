@extends('admin.template.main')

@section('title', 'Editar Tags '. $tag->name)

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
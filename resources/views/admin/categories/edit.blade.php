@extends('admin.template.main')

@section('title', 'Editar categoría '. $cat->name)

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

	{!! Form::open(['route' => ['admin.categories.update', $cat], 'method' => 'PUT']) !!}

	<div class="form-group">
		{!! Form::label('name', 'Nombre') !!}
		{!! Form::text('name', $cat->name, ['class' => 'form-control', 'placeholder' => 'Nombre de Categoría','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::submit('Editar categoría', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection
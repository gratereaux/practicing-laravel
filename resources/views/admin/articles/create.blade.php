@extends('admin.template.main')

@section('title', 'Agregar nuevo artículo')

@section('content')

	@include ('errors.list')

	{!! Form::open(['route' => 'admin.articles.store', 'method' => 'POST', 'files' => true]) !!}

	<div class="form-group">
		{!! Form::label('title', 'Título') !!}
		{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título del artículo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('category_id', 'Categoría') !!}
		{!! Form::select('category_id', $categories, null, ['class' => 'form-control chosen-cat','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('content', 'Contenido') !!}
		{!! Form::textarea('content', null, ['class' => 'form-control trumbowyg-content']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('image', 'Imagen') !!}
		{!! Form::file('image') !!}
	</div>
  
	<div class="form-group">
		{!! Form::label('tags', 'Quien lo puede ver?') !!}
		{!! Form::select('tags[]', $tags, null, ['class' => 'form-control chosen-tag', 'multiple', 'required']) !!}
	</div>
 


	<div class="form-group">
		{!! Form::submit('Crear artículo ', ['class' => 'btn btn-primary']) !!}
	</div>

	{!! Form::close() !!}

@endsection


@section('script')
	
	<script type="text/javascript">

		$('.chosen-tag').chosen({
			no_results_text: "Oops, no encuentro tags con ",
			placeholder_text_multiple: 'Selecciona uno o varios Tags...'
		});

		$('.chosen-cat').chosen();

		$('.trumbowyg-content').trumbowyg();

	</script>
	

@endsection
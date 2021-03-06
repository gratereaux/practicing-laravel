@extends('admin.template.main')

@section('title', 'Editar artículo ' . $article->title)

@section('content')

	@include ('errors.list')

	{!! Form::model($article, ['route' => ['admin.articles.update', $article], 'method' => 'PUT']) !!}

	<div class="form-group">
		{!! Form::label('title', 'Título') !!}
		{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Título del artículo','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('category_id', 'Categoría') !!}
		{!! Form::select('category_id', $categories, $article->category->id, ['class' => 'form-control chosen-cat','required']) !!}
	</div>

	<div class="form-group">
		{!! Form::label('content', 'Contenido') !!}
		{!! Form::textarea('content', null, ['class' => 'form-control trumbowyg-content']) !!}
	</div>
  
	<div class="form-group">
		{!! Form::label('tags', 'Tags') !!}
		{!! Form::select('tags[]', $tags, $my_tags, ['class' => 'form-control chosen-tag', 'multiple', 'required']) !!}
	</div>
 


	<div class="form-group">
		{!! Form::submit('Editar el artículo ', ['class' => 'btn btn-primary']) !!}
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
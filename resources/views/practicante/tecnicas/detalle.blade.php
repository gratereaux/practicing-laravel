@extends('admin.template.main')

@section('title', 'Detalle de Tecnicas')

@section('content')

	<a href="{{ route('practicante.tecnicas.index') }}" id="register-btn" class="btn btn-default navbar-btn">Ver todos las técnicas</a>
	
	<h2>{{ $article->title }}</h2>
	<div class="well well-lg">
		<p class="navbar-text">{!! $article->content !!}</p>
	</div>

	@if($article->image)
	<img src="/images/articles/{{ $article->image }}">
	@endif
@endsection
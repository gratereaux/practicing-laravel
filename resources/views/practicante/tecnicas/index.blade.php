@extends('admin.template.main')

@section('title', 'Detalle de Tecnicas')

@section('content')
	
	<h2>Técnicas de {{Auth::user()->name}}</h2>
	<table class="table tanle-striped">
		<thead>
			<th>Título</th>
			<th>Categoría</th>
			<th>Acción</th>
		</thead>

	<tbody>
	@foreach($articles as $article)
		<tr>
			<td>
				<a href="{{ route('practicante.tecnicas.show', $article->id) }}">
					{{ $article->title }}
				</a>
			</td>
			<td>{{ $article->category->name }}</td>
			<td>
				<a href="{{ route('practicante.tecnicas.show', $article->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-file"> LEER</span></a>
			</td>
		</tr>
	@endforeach
	</tbody>
	</table>

@endsection
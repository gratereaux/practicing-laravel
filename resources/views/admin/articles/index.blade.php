@extends('admin.template.main')

@section('title', 'Listado de Articulos')

@section('content')

	<a href="{{ route('admin.articles.create') }}" id="register-btn" class="btn btn-info">Agregar nuevo artículo</a>

	{!! Form::open(['route' => 'admin.articles.index', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}

		<div class="input-group">
			
			{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Buscar Articulo...', 'aria-describedby' => 'search']) !!}
			<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></span>

		</div>

	{!! Form::close() !!}

	<table class="table tanle-striped">
		<thead>
			<th>ID</th>
			<th>Título</th>
			<th>Usuario</th>
			<th>Categoría</th>
			<th>Accion</th>
		</thead>

	<tbody>
		@foreach ($arts as $art)
			<tr>
				<td>{{ $art->id }}</td>
				<td>{{ $art->title }}</td>
				<td>{{ $art->user->name }}</td>
				<td>{{ $art->category->name }}</td>
				<td>
					<a href="{{ route('admin.articles.edit', $art->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a> 
					<a href="{{ route('admin.articles.destroy', $art->id) }}" onclick="return confirm('Seguro que deseas eliminar el artículo?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>
		@endforeach
	</tbody>

	</table>

	{!! $arts->render() !!}

@endsection
@extends('admin.template.main')

@section('title', 'Lista de categorías')

@section('content')

	<a href="{{ route('admin.categories.create') }}" id="register-btn" class="btn btn-info">Agregar nueva categoría</a>

		<table class="table tanle-striped">
		<thead>
			<th>ID</th>
			<th>Categoría</th>
			<th>Fecha creado</th>
			<th>Accion</th>
		</thead>

	<tbody>
		@foreach ($cats as $cat)
			<tr>
				<td>{{ $cat->id }}</td>
				<td>{{ $cat->name }}</td>
				<td>{{ $cat->created_at }}</td>
				<td>
					<a href="{{ route('admin.categories.edit', $cat->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a> 
					<a href="{{ route('admin.categories.destroy', $cat->id) }}" onclick="return confirm('Seguro que deseas eliminar la categoría?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>
		@endforeach
	</tbody>

	</table>

	{!! $cats->render() !!}

@endsection
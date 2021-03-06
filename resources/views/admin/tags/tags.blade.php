@extends('admin.template.main')

@section('title', 'Lista de Tags')

@section('content')

	<a href="{{ route('admin.tags.create') }}" id="register-btn" class="btn btn-info">Agregar nuevo Tag</a>

	{!! Form::open(['route' => 'admin.tags.index', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}

		<div class="input-group">
			
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Tag...', 'aria-describedby' => 'search']) !!}
			<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></span>

		</div>

	{!! Form::close() !!}

		<table class="table tanle-striped">
		<thead>
			<th>ID</th>
			<th>Tag</th>
			<th>Fecha creado</th>
			<th>Accion</th>
		</thead>

	<tbody>
		@foreach ($tags as $tag)
			<tr>
				<td>{{ $tag->id }}</td>
				<td>{{ $tag->name }}</td>
				<td>{{ $tag->created_at }}</td>
				<td>
					<a href="{{ route('admin.tags.edit', $tag->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a> 
					<a href="{{ route('admin.tags.destroy', $tag->id) }}" onclick="return confirm('Seguro que deseas eliminar el Tag?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>
		@endforeach
	</tbody>

	</table>

	{!! $tags->render() !!}

@endsection
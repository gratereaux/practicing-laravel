@extends('admin.template.main')

@section('title', 'Lista de usuarios')

@section('content')

	<a href="{{ route('admin.users.create') }}" id="register-btn" class="btn btn-info">Registrar nuevo usuario</a>
	
	{!! Form::open(['route' => 'admin.users.index', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}

		<div class="input-group">
			
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar Usuario...', 'aria-describedby' => 'search']) !!}
			<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></span>

		</div>

	{!! Form::close() !!}

	<table class="table tanle-striped">
		<thead>
			<th>ID</th>
			<th>Nombre</th>
			<th>Username</th>
			<th>Correo</th>
			<th>Tipo</th>
			<th>Accion</th>
		</thead>

	<tbody>
		@foreach ($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ $user->name }}</td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->email }}</td>
				<td> 
					@if($user->type == "admin")
						<span class="label label-danger">{{ $user->type }}</span>
					@else
						<span class="label label-primary">{{ $user->type }}</span>
					@endif

				</td>
				<td>
					<a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a> 
					<a href="{{ route('admin.users.destroy', $user->id) }}" onclick="return confirm('Seguro que deseas eliminar el usuario?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>
		@endforeach
	</tbody>

	</table>

	{!! $users->render() !!}

@endsection
@extends('admin.template.main')

@section('title', 'Listado de practicantes')

@section('content')

	<a href="{{ route('admin.practicantes.create') }}" id="register-btn" class="btn btn-info">Registrar nuevo Practicante</a>
	
	{!! Form::open(['route' => 'admin.practicantes.index', 'method' => 'GET', 'class' => 'navbar-form pull-left']) !!}

		<div class="input-group">
			
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Buscar por nombre...', 'aria-describedby' => 'search']) !!}
			<span class="input-group-addon" id="search"><span class="glyphicon glyphicon-search"></span></span>

		</div>
	@if(isset($_GET['name']))
		<a href="{{ route('admin.practicantes.index') }}" class="ver-todos">Ver todos</a>
	@endif
	{!! Form::close() !!}
	

	<table class="table tanle-striped">
		<thead>

			<th>Nombre</th>
			<th>Rango</th>
			<th>Dojo</th>
			<th>Tipo de Miembro</th>
			<th>Accion</th>
		</thead>

	<tbody>
		
		@foreach ($practicantes as $practicante)
			<tr>
				<td>{{ $practicante->name }}</td>
				<td> 
					@if($ranks[$practicante->actual_rank] == "Kaiden")
						<span class="label label-rank-red">{{ $ranks[$practicante->actual_rank] }} <span></span></span>
					@elseif($ranks[$practicante->actual_rank] == "Menkyo")
						<span class="label label-rank-menkyo"> <span></span> &nbsp; {{ $ranks[$practicante->actual_rank] }} &nbsp; <span></span></span>
					@elseif($ranks[$practicante->actual_rank] == "Mokuroku")
						<span class="label label-rank-mokuroku">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "Okuiri")
						<span class="label label-rank-okuiri">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "1Kyu")
						<span class="label label-rank-brown">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "2Kyu")
						<span class="label label-rank-brown">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "3Kyu")
						<span class="label label-rank-brown">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "4Kyu")
						<span class="label label-rank-green">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "5Kyu")
						<span class="label label-rank-yellow">{{ $ranks[$practicante->actual_rank] }}</span>
					@elseif($ranks[$practicante->actual_rank] == "6Kyu")
						<span class="label label-rank-orange">{{ $ranks[$practicante->actual_rank] }}</span>
					@else
						<span class="label label-rank-white">{{ $ranks[$practicante->actual_rank]}}</span>
					@endif

				</td>
				<td>{{ $dojos[$practicante->dojo] }}</td>
				<td>{{ $type[$practicante->typemember] }}</td>
				<td>
					<a href="{{ route('admin.pagos.show', $practicante->id) }}" class="btn btn-primary"><span class="glyphicon glyphicon-usd"></span></a> 
					<a href="{{ route('admin.practicantes.edit', $practicante->id) }}" class="btn btn-warning"><span class="glyphicon glyphicon-wrench"></span></a> 
					<a href="{{ route('admin.practicantes.destroy', $practicante->id) }}" onclick="return confirm('Seguro que deseas eliminar el practicante?')" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>
				</td>
			</tr>


		@endforeach

	</tbody>

	</table>

	

@endsection
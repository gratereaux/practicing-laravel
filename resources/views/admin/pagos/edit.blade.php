@extends('admin.template.main')

@section('title', 'Ficha de pago')

@section('content')

<a href="{{ route('admin.pagos.show', $practicante->id) }}" id="register-btn" class="btn btn-default navbar-btn">Ver todos los pagos</a>


	<div class="panel-group">
	    <h3>Perfil de {{ $practicante->name }}</h3>
	  <div class="panel panel-default">
	    <div class="panel-body list-profile">
	    	
			<div class="list-group" style="width: 230px;">
			  <a class="list-group-item active">
			    <h4 class="list-group-item-heading">Cinturón</h4>

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
			  </a>
			</div>
			@if($practicante->bbnumber != '')
				<div class="list-group" style="width: 130px;">
				  <a class="list-group-item active">
				    <h4 class="list-group-item-heading">Black belt</h4>
				    <p class="list-group-item-text">{{ $practicante->bbnumber }}</p>
				  </a>
				</div>	
			
			@endif

			<div class="list-group" style="width: 150px;">
			  <a class="list-group-item active">
			    <h4 class="list-group-item-heading">Dojo</h4>
			    <p class="list-group-item-text">{{ $dojos[$practicante->dojo] }}</p>
			  </a>
			</div>

			<div class="list-group" style="width: 130px;">
			  <a class="list-group-item active">
			    <h4 class="list-group-item-heading">Miembro</h4>
			    <p class="list-group-item-text">{{ $type[$practicante->typemember] }}</p>
			  </a>
			</div>

			<div class="list-group" style="width: 200px;">
			  <a class="list-group-item active">
			    <h4 class="list-group-item-heading">Correo</h4>
			    <p class="list-group-item-text">{{ $practicante->email }}</p>
			  </a>
			</div>

			<div class="list-group" style="width: 200px;">
			  <a class="list-group-item active">
			    <h4 class="list-group-item-heading">Ingreso</h4>
			    <p class="list-group-item-text">{{ $practicante->yearbegin }}</p>
			  </a>
			</div>			

	    </div>
	  </div>
	</div>

<h3>Edición de pago</h3>


	{!! Form::open(['route' => ['admin.pagos.update', $pago->id], 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('concepto', 'Concepto') !!}
			{!! Form::select('concepto', $conceptos, $pago->concepto, ['class' => 'form-control chosen-dojo','required', 'placeholder' => '-- Seleccione --']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('fecha_pago', 'Fecha del pago') !!}
			{!! Form::date('fecha_pago', $pago->fecha_pago, ['class' => 'form-control', 'placeholder' => '99-99-9999','required']) !!}
		</div>	

		<div class="form-group">
			{!! Form::label('is_paid', 'Tipo de pago') !!}
			{!! Form::select('is_paid', ['Abono', 'Completo'], $pago->is_paid, ['class' => 'form-control','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('ammount', 'Monto') !!}
			{!! Form::number('ammount', $pago->ammount, ['class' => 'form-control', 'placeholder' => 'Monto a pagar','required']) !!}
		</div>
		
		<div class="form-group">
			{!! Form::label('comments', 'Comentarios') !!}
			{!! Form::textarea('comments', $pago->comments, ['class' => 'form-control trumbowyg-content']) !!}
		</div>

		<div class="form-group">
			{!! Form::submit('Modificar pago', ['class' => 'btn btn-warning', 'style' => 'font-size: 25px']) !!}
		</div>

	{!! Form::close() !!}



@endsection
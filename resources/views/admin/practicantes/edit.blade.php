@extends('admin.template.main')

@section('title', 'Editar el practicante ' . $practicante->name)

@section('content')

	@if (count($errors) > 0)
		<div class="alert alert-danger" role="alert">
			<ul>
				@foreach($errors->all() as $error)
				 	<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	

	{!! Form::open(['route' => ['admin.practicantes.update', $practicante], 'method' => 'PUT']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name', $practicante->name, ['class' => 'form-control', 'placeholder' => 'Nombre del practicante','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('dojo', 'Dojo principal') !!}
			{!! Form::select('dojo', $dojos, $practicante->dojo, ['class' => 'form-control chosen-dojo','required', 'placeholder' => '-- Seleccione una escuela --']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('typemember', 'Tipo de Miembro') !!}
			{!! Form::select('typemember', $type, $practicante->typemember, ['class' => 'form-control chosen-type', 'required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('actual_rank', 'Rango Actual') !!}
			{!! Form::select('actual_rank', $ranks, $practicante->actual_rank, ['class' => 'form-control chosen-actualrank','required', 'placeholder' => '-- Seleccione una Cinturón --', 'onchange' => 'showbbnumberform(this.value)']) !!}
		</div>

		<div class="form-group bbnumber-type" style="display: none;">
			{!! Form::label('bbnumber', 'Numero de cinturón negro') !!}
			{!! Form::text('bbnumber', $practicante->bbnumber, ['class' => 'form-control', 'placeholder' => 'Ejemplo: RD404, BB134']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'E-mail') !!}
			{!! Form::text('email', $practicante->email, ['class' => 'form-control', 'placeholder' => 'Correo Electrónico']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('yearbegin', 'Fecha de iniciado') !!}
			{!! Form::date('yearbegin', $practicante->yearbegin, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('policecourse', 'Cursos Realizados') !!}
			{!! Form::select('policecourse[]', $cursos, preg_split("/[,]+/", $practicante->policecourse), ['class' => 'form-control chosen-cursos', 'multiple']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('comments', 'Comentarios') !!}
			{!! Form::textarea('comments', $practicante->comments, ['class' => 'form-control trumbowyg-content']) !!}
		</div>


		<div class="form-group">
			{!! Form::submit('Editar practicante', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}


@endsection


@section('script')

	<script type="text/javascript">
		$('.chosen-dojo').chosen();
		$('.chosen-actualrank').chosen();

		$('.chosen-type').chosen({
			placeholder_text_multiple: 'Selecciona uno o varias...'
		});

		$('.chosen-cursos').chosen({
			no_results_text: "Oops, no encuentro cursos con ",
			placeholder_text_multiple: 'Selecciona uno o varios Cursos...'
		});

		function showbbnumberform(value){
			//mayor o igual a 7 es cinturon negro
			if (value > 6){
				$('.bbnumber-type').show();
			}else{
				$('.bbnumber-type').hide();
			}
			
		}

		$('.trumbowyg-content').trumbowyg();


	</script>

@endsection
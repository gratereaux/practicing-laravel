@extends('admin.template.main')

@section('title', 'Creación de practicante')

@section('content')

	@include ('errors.list')

	{!! Form::open(['route' => 'admin.practicantes.store', 'method' => 'POST']) !!}

		<div class="form-group">
			{!! Form::label('name', 'Nombre') !!}
			{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre del practicante','required']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('dojo', 'Dojo principal') !!}
			{!! Form::select('dojo', $dojos, null, ['class' => 'form-control chosen-dojo','required', 'placeholder' => '-- Seleccione una escuela --']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('typemember', 'Tipo de Miembro') !!}
			{!! Form::select('typemember', $type, null, ['class' => 'form-control chosen-type', 'required', 'placeholder' => '-- Seleccione una opción --']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('actual_rank', 'Rango Actual') !!}
			{!! Form::select('actual_rank', $ranks, null, ['class' => 'form-control chosen-actualrank','required', 'placeholder' => '-- Seleccione una Cinturón --', 'onchange' => 'showbbnumberform(this.value)']) !!}
		</div>

		<div class="form-group bbnumber-type" style="display: none;">
			{!! Form::label('bbnumber', 'Numero de cinturón negro') !!}
			{!! Form::text('bbnumber', null, ['class' => 'form-control', 'placeholder' => 'Ejemplo: RD404, BB134']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('email', 'E-mail') !!}
			{!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Correo Electrónico']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('yearbegin', 'Fecha de iniciado') !!}
			{!! Form::date('yearbegin', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('policecourse', 'Cursos Realizados') !!}
			{!! Form::select('policecourse[]', $cursos, null, ['class' => 'form-control chosen-cursos', 'multiple']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('comments', 'Comentarios') !!}
			{!! Form::textarea('comments', null, ['class' => 'form-control trumbowyg-content']) !!}
		</div>


		<div class="form-group">
			{!! Form::submit('Crear practicante', ['class' => 'btn btn-primary']) !!}
		</div>

	{!! Form::close() !!}

@endsection

@section('script')

	<script type="text/javascript">
		$('.chosen-dojo').chosen();
		$('.chosen-actualrank').chosen();
		$('.chosen-type').chosen();

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
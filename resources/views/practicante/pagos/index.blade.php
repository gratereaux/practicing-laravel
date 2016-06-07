@extends('admin.template.main')

@section('title', 'Recibos de Pago')

@section('content')
	
	<h2>Recibos de pago de {{Auth::user()->name}}</h2>

	<table class="table tanle-striped">
		<thead>
			<th></th>
			<th>Fecha de pago</th>
			<th>Concepto</th>
			<th>Monto</th>
			<th>Acción</th>
		</thead>

	<tbody>
	@foreach($pagos as $pago)
		<tr>
			<td>
				@if($pago->is_paid == 1)
					<a class="btn btn-success"></a>
				@else
					<a class="btn btn-danger"></a>
				@endif
			</td>
			<td>{{ $pago->fecha_pago }}</td>
			<td>{{ $conceptos[$pago->concepto] }}</td>
			<td>RD${{ $pago->ammount }}</td>
			<td>
				<a href="{{ route('practicante.pagos.show', $pago->id) }}" class="btn btn-success"><span class="glyphicon glyphicon-file"> DETALLE</span></a>
			</td>
		</tr>
	@endforeach
	</tbody>
	</table>

@endsection
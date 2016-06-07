@extends('admin.template.main')

@section('title', 'Recibos de Pago')

@section('content')
	
	<h2>Detalle de pago {{Auth::user()->name}}</h2>



	<p>{{ $pago->comments }}</p>
<!-- 	
	"id" => 2
    "practicante_id" => 10
    "ammount" => 500
    "fecha_pago" => "2016-05-31"
    "concepto" => "1"
    "is_paid" => 1
    "comments" => "Derecho de examen a 6to Kyu"
    "created_at" => "2016-05-31 13:58:13"
    "updated_at" => "2016-05-31 13:58:13" 
-->

@endsection
@extends('plantillas.main')
@section('title', 'Listar-marcas')
@section('content')
	<div class="col-md-4"></div>
	<div class="col-md-4">
		@include('marca.formularios.createForm')
	</div>
	<div class="col-md-4"></div>
@endsection
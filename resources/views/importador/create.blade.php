@extends('plantillas.main')
@section('title', 'Crear Importador')
@section('content')
	<div class="col-md-4"></div>
	<div class="col-md-4">
		@include('importador.formularios.createForm')
	</div>
	<div class="col-md-4"></div>
	
@endsection
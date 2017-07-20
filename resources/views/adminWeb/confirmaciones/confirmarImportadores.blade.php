@extends('plantillas.adminWeb.mainAdmin')
@section('title', 'Confirmar Importadores')

@section('title-header')
   Confirmación de Importadores 
@endsection

@section('title-complement')
   (Marcas sin Propietario)
@endsection

@section('content-left')
   @section('alertas')
      @if (Session::has('msj-success'))
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>¡Enhorabuena!</strong> {{Session::get('msj-success')}}.
         </div>
      @endif
   @endsection
   
   <ul class="timeline">
      @foreach($solicitudes as $solicitud)
         <?php 
            $importador = DB::table('importador')
                           ->select('id', 'nombre', 'pais_id')
                           ->where('id', '=', $solicitud->importador_id)
                           ->get()
                           ->first();

            $pais = DB::table('pais')
                     ->select('pais')
                     ->where('id', '=', $importador->pais_id)
                     ->get()
                     ->first();

            $marca = DB::table('marca')
                           ->where('id', '=', $solicitud->marca_id)
                           ->get()
                           ->first();             
         ?>

         <li>
            <i class="fa fa-hand-pointer-o bg-blue"></i>

            <div class="timeline-item">
               <span class="time"><i class="fa fa-clock-o"></i> {{ date('d-m-Y', strtotime($solicitud->created_at)) }}</span>

               <h3 class="timeline-header"><a href="#">{{ $importador->nombre }}</a> ha indicado que importa una marca sin propietario.</h3>

               <div class="timeline-body">
                  El importador <strong>{{ $importador->nombre }}</strong> ha indicado que importa la marca <strong>{{ $marca->nombre }}</strong> en <strong>{{ $pais->pais }}</strong>...
               </div>
            
               <div class="timeline-footer">
                  <a class="btn btn-primary btn-xs" href="{{ route('admin.confirmar-importador', [$solicitud->id, 'S']) }}">¡Confirmar!</a>
                  <a class="btn btn-danger btn-xs" href="{{ route('admin.confirmar-importador', [$solicitud->id, 'N']) }}">¡No Confirmar!</a>
               </div>
            </div>
         </li>
      @endforeach
   </ul>
@endsection

@section('pagination')
   {{$solicitudes->render()}}
@endsection
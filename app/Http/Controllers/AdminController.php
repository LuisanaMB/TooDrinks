<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca; use App\Models\Producto;
use App\Models\Productor;
use DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminWeb.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function marcas_sin_aprobar(){
        $marcas = Marca::orderBy('nombre')
                    ->where('publicada', '=', '0')
                    ->paginate(9);

        return view('adminWeb.marcasSinAprobar')->with(compact('marcas'));
    }

    public function aprobar_marca($id, Request $request){
        if ($id != '0'){
            $actualizacion = DB::table('marca')
                            ->where('id', '=', $id)
                            ->update(['publicada' => '1']);
        }else{
            $actualizacion = DB::table('marca')
                            ->where('id', '=', $request->marca_id)
                            ->update(['publicada' => '1']);
        }

        return redirect('admin/marcas-sin-aprobar')->with('msj', 'La marca ha sido aprobada y publicada exitosamente');
    }

    public function rechazar_marca(Request $request, $id){
       
    }

    public function productos_sin_aprobar(){
        $productos = Producto::orderBy('nombre')
                    ->where('publicado', '=', '0')
                    ->paginate(8);

        return view('adminWeb.productosSinAprobar')->with(compact('productos'));
    }

    public function aprobar_producto($id, Request $request){
        if ($id != '0'){
            $actualizacion = DB::table('producto')
                            ->where('id', '=', $id)
                            ->update(['publicado' => '1']);
        }else{
            $actualizacion = DB::table('producto')
                            ->where('id', '=', $request->producto_id)
                            ->update(['publicado' => '1']);
        }

        return redirect('admin/productos-sin-aprobar')->with('msj', 'El producto ha sido aprobado y publicado exitosamente');
    }

    public function rechazar_producto(Request $request, $id){
       
    }

    public function marcas_sin_propietario(){
        $marcas = Marca::orderBy('nombre')
                    ->where('productor_id', '=', '0')
                    ->where('publicada', '=', '1')
                    ->paginate(9);

        return view('adminWeb.marcasSinPropietario')->with(compact('marcas'));
    }

    public function asociar_marca_productor(Request $request){
        $actualizacion = DB::table('marca')
                            ->where('id', '=', $request->marca_id)
                            ->update([ 'productor_id' => $request->productor_id,
                                       'reclamada' => '1'
                                    ]);

        $importadores = DB::table('importador_marca')
                            ->where('marca_id', '=', $request->marca_id)
                            ->get();

        foreach ($importadores as $importador)
            Productor::find($request->productor_id)->importadores()->attach($importador->importador_id);

        $distribuidores = DB::table('distribuidor_marca')
                            ->where('marca_id', '=', $request->marca_id)
                            ->get();

        foreach ($distribuidores as $distribuidor)
            Productor::find($request->productor_id)->distribuidores()->attach($distribuidor->distribuidor_id);

        return redirect('admin/marcas-sin-propietario')->with('msj', 'Se ha asociado correctamente el productor a la marca');
    }

    public function confirmar_importadores(){
        $solicitudes = DB::table('importador_marca')
                    ->select('importador_marca.*')
                    ->orderBy('created_at', 'DESC')
                    ->join('marca', 'importador_marca.marca_id', '=', 'marca.id')
                    ->where('marca.productor_id', '=', '0')
                    ->where('importador_marca.status', '=', '0')
                    ->paginate(9);

        return view('adminWeb.confirmarImportadores')->with(compact('solicitudes'));
    }

    public function confirmar_importador($id, $tipo){
        $solicitud = DB::table('importador_marca')
                        ->where('id', '=', $id)
                        ->first();

        if ($tipo == 'S'){
            $actualizacion = DB::table('importador_marca')
                                ->where('id', '=', $id)
                                ->update(['status' => '1']);

            $productor = Productor::find(0);
            $productor->importadores()->attach($solicitud->importador_id);

            return redirect('admin/confirmar-importadores-marcas')->with('msj', 'La relación Importador / Marca ha sido confirmada exitosamente');
        }else{
            DB::table('importador_marca')->where('id', '=', $id)->delete();

            return redirect('admin/confirmar-importadores-marcas')->with('msj', 'La relación Importador / Marca ha sido eliminada exitosamente');
        }
    }

     public function confirmar_distribuidores(){
        $solicitudes = DB::table('distribuidor_marca')
                    ->select('distribuidor_marca.*')
                    ->orderBy('created_at', 'DESC')
                    ->join('marca', 'distribuidor_marca.marca_id', '=', 'marca.id')
                    ->where('marca.productor_id', '=', '0')
                    ->where('distribuidor_marca.status', '=', '0')
                    ->paginate(9);

        return view('adminWeb.confirmarDistribuidores')->with(compact('solicitudes'));
    }

    public function confirmar_distribuidor($id, $tipo){
        $solicitud = DB::table('distribuidor_marca')
                        ->where('id', '=', $id)
                        ->first();

        if ($tipo == 'S'){
            $actualizacion = DB::table('distribuidor_marca')
                                ->where('id', '=', $id)
                                ->update(['status' => '1']);

            Productor::find(0)->distribuidores()->attach($solicitud->distribuidor_id);

            return redirect('admin/confirmar-distribuidores-marcas')->with('msj', 'La relación Distribuidor / Marca ha sido confirmada exitosamente');
        }else{
            DB::table('distribuidor_marca')->where('id', '=', $id)->delete();

            return redirect('admin/confirmar-distribuidores-marcas')->with('msj', 'La relación Distribuidor / Marca ha sido eliminada exitosamente');
        }
    }
}

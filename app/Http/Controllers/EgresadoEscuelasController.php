<?php

namespace App\Http\Controllers;

use App\EgresadoEscuelas;
use Illuminate\Http\Request;

class EgresadoEscuelasController extends Controller
{
    public function index()
    {
        $egresadoescuelas = EgresadoEscuelas::all(); 
        return response()->json($egresadoescuelas);
    }

    public function create(Request $request)
    {
        $egresadoEscuela = new EgresadoEscuelas();
        $egresadoEscuela->fecha_ingreso = $request->fecha_ingreso;
        $egresadoEscuela->fecha_egreso = $request->fecha_egreso;
        $egresadoEscuela->descripcion = $request->descripcion;
        $egresadoEscuela->escuela_profesiona_id = $request->escuela_profesiona_id;
        $egresadoEscuela->egresado_id = $request->egresado_id;
        $egresadoEscuela->save();
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
        $egresadoescuelas= EgresadoEscuelas::find($id);
        return response()->json($egresadoescuelas);
    }
    public function update(Request $request, $id)
    {
        EgresadoEscuelas::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        EgresadoEscuelas::findOrFail($id)->delete();
    }
}

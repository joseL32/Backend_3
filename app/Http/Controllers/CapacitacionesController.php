<?php

namespace App\Http\Controllers;
use App\User;
use App\Capacitaciones;
use Illuminate\Http\Request;

class CapacitacionesController extends Controller
{
    public function index()
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('capacitaciones', 'capacitaciones.egresado_id', '=', 'egresados.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('capacitaciones.id','capacitaciones.nombre','capacitaciones.informacion',
        'capacitaciones.fecha_inicio','capacitaciones.fecha_fin','capacitaciones.direccion',
        'capacitaciones.tipo','capacitaciones.precio','capacitaciones.rutas')
        ->get();
        return response()->json($result);
    }

    public function create(Request $request)
    {


        $capacitaciones = new Capacitaciones();
        $capacitaciones->nombre = $request->nombre;
        $capacitaciones->informacion = $request->informacion;
        $capacitaciones->fecha_inicio = $request->fecha_inicio;
        $capacitaciones->fecha_fin = $request->fecha_fin;
        $capacitaciones->direccion = $request->direccion;
        $capacitaciones->tipo = $request->tipo;
        $capacitaciones->precio = $request->precio;
        $capacitaciones->rutas = $request->rutas;
        $capacitaciones->egresado_id = $request->egresado_id;
        $capacitaciones->empresa_id = $request->empresa_id;
        $capacitaciones->save();
        return response()->json($capacitaciones);
    }
    public function show($id)
    {
        $capacitaciones= Capacitaciones::findOrFail($id);
        return response()->json($capacitaciones);
    }
    public function update(Request $request, $id)
    {
        $capacitaciones = Capacitaciones::findOrFail($id);
        $capacitaciones->nombre = $request->nombre;
        $capacitaciones->informacion = $request->informacion;
        $capacitaciones->fecha_inicio = $request->fecha_inicio;
        $capacitaciones->fecha_fin = $request->fecha_fin;
        $capacitaciones->direccion = $request->direccion;
        $capacitaciones->tipo = $request->tipo;
        $capacitaciones->precio = $request->precio;
        $capacitaciones->rutas = $request->rutas;
        $capacitaciones->egresado_id = $request->egresado_id;
        $capacitaciones->empresa_id = $request->empresa_id;
        $capacitaciones->save();
        return response()->json($capacitaciones);
    }
    public function destroy($id)
    {
        Capacitaciones::findOrFail($id)->delete();
    }
}

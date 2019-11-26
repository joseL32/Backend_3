<?php

namespace App\Http\Controllers;

use App\Sugerencias;
use Illuminate\Http\Request;

class SugerenciasControler extends Controller
{
    
    public function index()
    {
        $sugerencias = Sugerencias::all(); 
        return response()->json($sugerencias);
    }

    public function create(Request $request)
    {

        $sugerencias = new Sugerencias();
        $sugerencias->comentario_egresado = $request->comentario_egresado;
        $sugerencias->fecha_creacion = $request->fecha_creacion;
        $sugerencias->tipo_comentario = $request->tipo_comentario;
        $sugerencias->user_creador = $request->user_creador;
        $sugerencias->save();
    }
    public function show($id)
    {
        $sugerencias= Sugerencias::findOrFail($id);
        return response()->json($sugerencias);
    }
    public function updateComentario(Request $request, $id)
    {
        $sugerencias = Sugerencias::findOrFail($id);
        $sugerencias->comentario_egresado = $request->comentario_egresado;
        $sugerencias->tipo_comentario = $request->tipo_comentario;
        $sugerencias->save();
        return response()->json($sugerencias);
    }
    public function updateAdmin(Request $request, $id)
    {
        $sugerencias = Sugerencias::findOrFail($id);
        $sugerencias->comentario_respuesta = $request->comentario_respuesta;
        $sugerencias->fecha_atencion = $request->fecha_atencion;
        $sugerencias->user_administrador = $request->user_administrador;
        $sugerencias->save();
        return response()->json($sugerencias);
    }
    public function destroy($id)
    {
        Sugerencias::findOrFail($id)->delete();
    }
}

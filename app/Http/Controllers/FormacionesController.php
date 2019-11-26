<?php

namespace App\Http\Controllers;
use App\User;
use App\FormacionesBasicas;
use Illuminate\Http\Request;

class FormacionesController extends Controller
{
    public function index()
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('formaciones_basicas', 'formaciones_basicas.egresado_id', '=', 'egresados.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('formaciones_basicas.id','formaciones_basicas.nombre','formaciones_basicas.fech_inicio','formaciones_basicas.fech_fin','formaciones_basicas.rutas')
        ->get();
        return response()->json($result);
    }

    public function create(Request $request)
    {
        $formaciones = new FormacionesBasicas();
        $formaciones->nombre = $request->nombre;
        $formaciones->fech_inicio = $request->fech_inicio;
        $formaciones->fech_fin = $request->fech_fin;
        $formaciones->rutas = $request->rutas;
        $formaciones->egresado_id = $request->egresado_id;
        $formaciones->save();
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
        $formaciones= FormacionesBasicas::find($id);
        return response()->json($formaciones);
    }
    public function update(Request $request, $id)
    {
        FormacionesBasicas::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        FormacionesBasicas::findOrFail($id)->delete();
    }
}

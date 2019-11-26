<?php

namespace App\Http\Controllers;
use App\User;
use App\Empresas;
use Illuminate\Http\Request;

class EmpresasController extends Controller
{
    public function index()
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('empresas', 'empresas.egresado', '=', 'egresados.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('empresas.id','empresas.nombre','empresas.telefono','empresas.tipo','empresas.direccion','empresas.correo')
        ->get();
        return response()->json($result);
    }

    public function create(Request $request)
    {

        $empresas = new Empresas();
        $empresas->nombre = $request->nombre;
        $empresas->telefono = $request->telefono;
        $empresas->tipo = $request->tipo;
        $empresas->direccion = $request->direccion;
        $empresas->correo = $request->correo;
        $empresas->egresado = $request->egresado;
        $empresas->save();
        return response()->json($empresas);
    }
    public function show($id)
    {
        $empresas= Empresas::find($id);
        return response()->json($empresas);
    }
    public function update(Request $request, $id)
    {
        Empresas::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        Empresas::findOrFail($id)->delete();
    }
}

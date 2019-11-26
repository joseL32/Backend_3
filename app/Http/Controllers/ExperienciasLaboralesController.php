<?php

namespace App\Http\Controllers;
use App\User;
use App\ExperienciasLaborales;
use Illuminate\Http\Request;

class ExperienciasLaboralesController extends Controller
{
    public function index(Request $request)
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('experiencias_laborales', 'experiencias_laborales.egresado_id', '=', 'egresados.id')
        ->join('empresas', 'experiencias_laborales.empresa_id', '=', 'empresas.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('experiencias_laborales.id','experiencias_laborales.validacion_fecha','experiencias_laborales.is_validando',
        'experiencias_laborales.descripcion_val','empresas.nombre as empresa')
        ->get();
        return response()->json($result);
    }

    public function create(Request $request)
    {
        $exp = new ExperienciasLaborales();
        $exp->empresa_id = $request->empresa_id;
        $exp->egresado_id = $request->egresado_id;
        $exp->save();
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
        $exp= ExperienciasLaborales::find($id);
        return response()->json($exp);
    }
    public function update(Request $request, $id)
    {
        ExperienciasLaborales::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        ExperienciasLaborales::findOrFail($id)->delete();
    }
}

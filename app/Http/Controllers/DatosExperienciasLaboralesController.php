<?php

namespace App\Http\Controllers;

use App\DatosExperienciasLaborales;
use Illuminate\Http\Request;

class DatosExperienciasLaboralesController extends Controller
{
    
    public function create(Request $request)
    {
        $datos = new DatosExperienciasLaborales();
        $datos->descripccion = $request->descripccion;
        $datos->estado = $request->estado;
        $datos->cargo = $request->cargo;
        $datos->fech_inicio = $request->fech_inicio;
        $datos->fech_fin = $request->fech_fin;
        $datos->experiencia_laboral_id = $request->experiencia_laboral_id;
        $datos->save();
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
 
        $result = DatosExperienciasLaborales::join('experiencias_laborales', 'experiencia_laboral_id', '=', 'experiencias_laborales.id')
        ->where('experiencias_laborales.id','=',$id)
        ->select('datos_experiencias_laborales.descripccion','datos_experiencias_laborales.estado',
        'datos_experiencias_laborales.cargo',
        'datos_experiencias_laborales.fech_inicio','datos_experiencias_laborales.fech_fin')
        ->get();
        return response()->json($result);
    }
    public function update(Request $request, $id)
    {
        DatosExperienciasLaborales::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        DatosExperienciasLaborales::findOrFail($id)->delete();
    }
}

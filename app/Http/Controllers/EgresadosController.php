<?php

namespace App\Http\Controllers;
use App\User;
use App\Egresados;
use Illuminate\Http\Request;

class EgresadosController extends Controller
{ 
    public function index()
    {
        
        $egresados = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'personas.id','=','egresados.persona_id')
        ->join('provincias', 'egresados.domicilio_actual', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->select('users.email','personas.ap_paterno','personas.dni','personas.nombre'
        ,'personas.ap_materno','egresados.codigo','egresados.celular','egresados.estado_actualizaciones','egresados.fec_actualizacion'
        ,'paises.nombre as pais','departamentos.nombre as departamentos','provincias.nombre as provincia','egresados.id','users.id as userid')
        ->get();

        return response()->json($egresados);
    }

    public function create(Request $request)
    {
        $egresados = new Egresados();
        $egresados->codigo = $request->codigo;
        $egresados->celular = $request->celular;
        $egresados->estado_actualizaciones = $request->estado_actualizaciones;
        $egresados->fec_actualizacion = $request->fec_actualizacion;
        $egresados->persona_id = $request->persona_id;
        $egresados->domicilio_actual = $request->provincia;
        $egresados->pais = $request->pais;
        $egresados->departamento = $request->departamento;
        $egresados->save();
        return response()->json($egresados);
    }
    public function show($id)
    {
        $egresados= Egresados::find($id);
        return response()->json($egresados);
    }
    public function update(Request $request, $id)
    {
        Egresados::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        Egresados::findOrFail($id)->delete();
    }
    public function egresados(){
       $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
        ->join('provincias', 'egresados.domicilio_actual', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where('users.id','=',auth()->user()->id)
        ->select('users.name as usuario','users.avatar','personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.sexo'
        ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni'
        ,'egresados.codigo','egresados.celular','egresados.id')
        ->first();
        return response()->json($result);
    }

    public function egresadosEscuelas(){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
         ->join('egresados', 'egresados.persona_id', '=', 'personas.id')
         ->join('egresado_escuelas', 'egresado_escuelas.egresado_id', '=', 'egresados.id')
         ->join('escuela_profecionales', 'egresado_escuelas.escuela_profesiona_id', '=', 'escuela_profecionales.id')
         ->join('facultades', 'escuela_profecionales.facultad_id', '=', 'facultades.id')
         ->where('users.id','=',auth()->user()->id)
         ->select('facultades.nombre as facultad','escuela_profecionales.nombre as escuela','egresado_escuelas.fecha_ingreso','egresado_escuelas.fecha_egreso',
         'egresado_escuelas.descripcion')
         ->get();
         return response()->json($result);
     }
}

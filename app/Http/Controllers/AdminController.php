<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;

class AdminController extends Controller
{
    public function persona($id)
    {
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->join('provincias', 'personas.provincia', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        
        
        ->where('users.id','=',$id)
        ->select('users.name as usuario','users.avatar','personas.nombre','personas.ap_materno','users.rol',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo','personas.activo'
        ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','users.id as user_ID','provincias.nombre as provincia', 'personas.dni')
        ->first();
        return response()->json($result);
    }
    public function dependiente($id){
        $result = User::join('personas', 'personaid', '=', 'personas.id')
        ->where('users.id','=',$id)->first();
 
         $resultado = Persona::join('provincias', 'personas.provincia', '=', 'provincias.id')
        ->join('departamentos', 'provincias.dep_id', '=', 'departamentos.id')
        ->join('paises', 'departamentos.pais_id', '=', 'paises.id')
        ->where([['personas.dependiente','=',$result->id]])

        ->select('personas.nombre','personas.ap_materno',
        'personas.ap_paterno', 'paises.nombre as pais',
        'personas.email','personas.fec_nacimiento','personas.est_civil','personas.sexo'
        ,'personas.dependiente','departamentos.nombre as departamentos','personas.id as persona_ID','provincias.nombre as provincia')
        ->get();

        return response()->json($resultado); 
    }
}

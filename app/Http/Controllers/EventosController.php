<?php

namespace App\Http\Controllers;

use App\Eventos;
use Illuminate\Http\Request;

class EventosController extends Controller
{
    public function index()
    {
        $evento = Eventos::all(); 
        return response()->json($evento);
    }

    public function create(Request $request)
    {

        $file= $request->file('imagen'); 
        $name = time().$file->getClientOriginalName();
        $file->move(public_path().'/uploads/eventos',$name);
        $evento = new Eventos();
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->imagen = $name;
        $evento->fec_fin = $request->fec_fin;
        $evento->fec_inicio = $request->fec_inicio;
        $evento->save();
        return response()->json($evento);
    }
    public function show($id)
    {
        $evento= Eventos::findOrFail($id);
        return response()->json($evento);
    }
    public function update(Request $request, $id)
    {
        $evento = Eventos::findOrFail($id);
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fec_fin = $request->fec_fin;
        $evento->fec_inicio = $request->fec_inicio;;
        $evento->save();
        return response()->json($evento);
    }
    public function destroy($id)
    {
        Eventos::findOrFail($id)->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\EscuelaProfecionales;
use Illuminate\Http\Request;

class EscuelaProfecionalController extends Controller
{
    public function index()
    {
        $escuela_profesional = EscuelaProfecionales::all(); 
        return response()->json($escuela_profesional);
    }

    public function create(Request $request)
    {
        EscuelaProfecionales::create($request-> all());
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
        $escuela_profesional= EscuelaProfecionales::find($id);
        return response()->json($escuela_profesional);
    }
    public function update(Request $request, $id)
    {
        EscuelaProfecionales::findOrFail($id)->update($request->all());
    }
    public function destroy($id)
    {
        EscuelaProfecionales::findOrFail($id)->delete();
    }
}

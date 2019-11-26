<?php

namespace App\Http\Controllers;

use App\Facultades;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    public function index()
    {
        $facultad = Facultades::all(); 
        return response()->json($facultad);
    }

    public function create(Request $request)
    {
        Facultades::create($request-> all());
        return response()->json(['success'=> true]);
    }
    public function show($id)
    {
        $facultad= Facultades::find($id);
        return response()->json($facultad);
    }
    public function update(Request $request, $id)
    {
        Facultades::findOrFail($id)->update($request->all());
        return response()->json($request->all());
    }
    public function destroy($id)
    {
        Facultades::findOrFail($id)->delete();
    }
}

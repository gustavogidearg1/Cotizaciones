<?php

namespace App\Http\Controllers;

use App\Models\Localidad;
use App\Models\Provincia;
use App\Models\Pais;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LocalidadController extends Controller
{

public function index(Request $request)
{
    $query = \App\Models\Localidad::with(['provincia', 'pais'])
        ->join('provincia', 'localidad.provincia_id', '=', 'provincia.id')
        ->select('localidad.*')
        ->orderBy('localidad.nombre');

    if ($request->filled('buscar')) {
        $query->where('localidad.nombre', 'like', '%' . $request->buscar . '%');
    }

    if ($request->filled('provincia')) {
        $query->where('provincia.provincia', 'like', '%' . $request->provincia . '%');
    }

    $localidades = $query->paginate(20)->appends($request->all());

    return view('abm.localidad.index', compact('localidades'));
}




    public function create()
    {
        $provincias = Provincia::all();
        $paises = Pais::all();
        return view('abm.localidad.create', compact('provincias', 'paises'));
    }

    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'nombre' => 'required|unique:localidad,nombre',
        'cp' => 'required',
        'provincia_id' => 'required|exists:provincia,id',
        'pais_id' => 'required|exists:pais,id',
    ], [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.unique' => 'Ya existe una localidad con ese nombre.',
        'cp.required' => 'El código postal es obligatorio.',
        'provincia_id.required' => 'Debe seleccionar una provincia.',
        'provincia_id.exists' => 'La provincia no existe.',
        'pais_id.required' => 'Debe seleccionar un país.',
        'pais_id.exists' => 'El país no existe.',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }

    try {
        $localidad = \App\Models\Localidad::create([
            'nombre' => $request->nombre,
            'cp' => $request->cp,
            'provincia_id' => $request->provincia_id,
            'pais_id' => $request->pais_id,
        ]);

        // Cargar relaciones si las tenés definidas
        $provinciaNombre = $localidad->provincia->provincia ?? '';
        $paisNombre = $localidad->pais->pais ?? '';

return response()->json([
    'id' => $localidad->id,
    'nombre' => $localidad->nombre,
    'cp' => $localidad->cp,
    'provincia_id' => $localidad->provincia_id,
    'provincia_nombre' => $localidad->provincia ? $localidad->provincia->provincia : '',
    'pais_id' => $localidad->pais_id,
    'pais_nombre' => $localidad->pais ? $localidad->pais->pais : '',
]);

    } catch (\Throwable $e) {
        // Graba el error en el log
        \Log::error($e);
        // Devuelve mensaje simple al usuario
        return response()->json([
            'error' => 'Ocurrió un error interno al crear la localidad.'
        ], 500);
    }
}



    public function show($id)
    {
        $localidad = Localidad::with(['provincia', 'pais'])->findOrFail($id);
        return view('abm.localidad.show', compact('localidad'));
    }

    public function edit(Localidad $localidad)
    {
        $provincias = Provincia::all();
        $paises = Pais::all();
        return view('abm.localidad.edit', compact('localidad', 'provincias', 'paises'));
    }

    public function update(Request $request, Localidad $localidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:localidad,nombre,' . $localidad->id,
            'cp' => 'required|string|max:10',
            'provincia_id' => 'required|exists:provincia,id',
            'pais_id' => 'required|exists:pais,id',
        ]);

        $localidad->update($request->only('nombre', 'cp', 'provincia_id', 'pais_id'));

        return redirect()->route('localidad.index')->with('success', 'Localidad actualizada correctamente.');
    }

    public function destroy(Localidad $localidad)
    {
        $localidad->delete();
        return redirect()->route('localidad.index')->with('success', 'Localidad eliminada correctamente.');
    }
}

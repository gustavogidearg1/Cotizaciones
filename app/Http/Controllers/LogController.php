<?php

// app/Http/Controllers/LogController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index(){
        $logs = Log::orderBy('id','desc')->paginate(15);
        return view('logs.index', compact('logs'));
    }

    public function create()
    {
        return view('logs.create');
    }

    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'info'    => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
            'context' => 'nullable',
        ]);

          // Contexto base automático
    $autoContext = [
        'user_id' => auth()->id(),
        'ip'      => $request->ip(),
        'url'     => $request->fullUrl(),
        'method'  => $request->method(),
        'agent'   => $request->userAgent(),
    ];

    // Si el usuario pegó JSON en el textarea, lo mezclamos
    $userContext = [];
    if ($request->filled('context')) {
        $decoded = json_decode($request->input('context'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return back()->withInput()->withErrors([
                'context' => 'El Contexto debe ser JSON válido: '.json_last_error_msg()
            ]);
        }
        $userContext = $decoded; // array
    }

    $context = array_merge($autoContext, $userContext);

    Log::create([
        'info'    => $validated['info'] ?? null,
        'message' => $validated['message'],
        'context' => $context,        // se guarda como JSON por el cast
        'user_id' => auth()->id(),    // columna aparte en la tabla (si la tenés)
    ]);

    return redirect()->route('logs.index')->with('success', 'Log creado exitosamente.');
}

    public function show($id)
    {
        $log = Log::findOrFail($id);
        return view('logs.show', compact('log'));
    }

    public function destroy($id)
    {
        $log = Log::findOrFail($id);
        $log->delete();
        return redirect()->route('logs.index')->with('success', 'Log eliminado exitosamente.');
    }

    public function edit($id)
    {
        $log = Log::findOrFail($id);
        return view('logs.edit', compact('log'));
    }
    public function update(Request $request, $id)
    {
        // Validación
        $validated = $request->validate([
            'info'    => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
            'context' => 'nullable', // validaremos JSON manualmente abajo
        ]);

        // Parsear context si viene
        $context = null;
        if ($request->filled('context')) {
            $decoded = json_decode($request->input('context'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                return back()
                    ->withInput()
                    ->withErrors(['context' => 'El Contexto debe ser un JSON válido. Error: '.json_last_error_msg()]);
            }
            $context = $decoded; // array
        }

        // Actualizar registro
        $log = Log::findOrFail($id);
        $log->update([
            'info'     => $validated['info'] ?? null,
            'message'  => $validated['message'],
            'context'  => $context,           // array -> se guarda como JSON por el cast
        ]);

        return redirect()->route('logs.index')->with('success', 'Log actualizado exitosamente.');
    }




}

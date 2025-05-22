<?php
namespace App\Http\Controllers;
use App\Models\Moneda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonedaController extends Controller
{
    public function index()
    {
        $this->authorizeAccess();
        $monedas = Moneda::all();
        return view('abm.monedas.index', compact('monedas'));
    }

    public function create()
    {
        $this->authorizeAccess();
        return view('abm.monedas.create');
    }

    public function store(Request $request)
    {
        $this->authorizeAccess();
        $validated = $request->validate([
            'moneda' => 'required|string|max:50|unique:monedas',
            'desc_ampliada' => 'nullable|string|max:150',
            'tipo_cambio' => 'numeric|min:0|max:10000',
        ]);

        Moneda::create($validated);
        return redirect()->route('monedas.index')->with('success', 'Moneda creada correctamente.');
    }

    public function edit(Moneda $moneda)
    {
        $this->authorizeAccess();
        return view('abm.monedas.edit', compact('moneda'));
    }

    public function update(Request $request, Moneda $moneda)
    {
        $this->authorizeAccess();
        $validated = $request->validate([
            'moneda' => 'required|string|max:50|unique:monedas,moneda,' . $moneda->id,
            'desc_ampliada' => 'nullable|string|max:150',
            'tipo_cambio' => 'numeric|min:0|max:10000',
        ]);

        $moneda->update($validated);
        return redirect()->route('monedas.index')->with('success', 'Moneda actualizada correctamente.');
    }

    public function destroy(Moneda $moneda)
    {
        $this->authorizeAccess();
        $moneda->delete();
        return redirect()->route('monedas.index')->with('success', 'Moneda eliminada correctamente.');
    }

private function authorizeAccess()
{
    $user = Auth::user();

    if ($user === null || (!$user->isAdmin() && $user->id !== 1)) {
        abort(403, 'No autorizado');
    }
}


}

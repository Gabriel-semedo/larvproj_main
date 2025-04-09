<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    // Exibe a lista de visits
    public function index()
    {
        $visits = Visit::all(); // Obtém todas as visits

        return view('visits.index', ['visits' => $visits]); // Passando diretamente sem compact
    }

    // Exibe o formulário para criar uma nova visit
    public function create()
    {
        return view('visits.form');
    }

    // Salva a nova visit no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate' => 'required|string|unique:visits,plate',
            'company' => 'required|exists:company,id',
            'user' => 'required|exists:users,id',
        ]);

        // Verificar se a placa já existe
        $existingVisit = Visit::where('plate', $request->plate)->first();
        if ($existingVisit) {
            return redirect()->back()->withErrors(['plate' => 'Esta placa já está em uso.']);
        }

        try {
            Visit::create($request->all());
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == '23000') { // Código de violação de restrição única
                return redirect()->back()->withErrors(['plate' => 'Esta placa já está em uso.']);
            }
        }

        return redirect()->route('visits.index');
    }

    public function edit(Visit $visit)
    {
        return view('visits.form', ['visit' => $visit]); // Passando o objeto Visits diretamente
    }

    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate' => 'required|string|unique:visits,plate,' . $visit->id,
            'company' => 'required|exists:company,id',
            'user' => 'required|exists:users,id',
        ]);

        $visit->update($request->all());

        return redirect()->route('visits.index');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('visits.index');
    }
}
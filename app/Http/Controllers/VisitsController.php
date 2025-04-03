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
        return view('visits.create');
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

        Visit::create($request->all());

        return redirect()->route('visits.index');
    }

    public function edit(Visit $visit)
    {
        return view('visits.edit', ['visit' => $visit]); // Passando o objeto Visits diretamente
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

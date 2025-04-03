<?php

namespace App\Http\Controllers;

use App\Models\Visitas;
use Illuminate\Http\Request;

class VisitasController extends Controller
{
    // Exibe a lista de visitas
    public function index()
    {
        $visitas = Visitas::all(); // Obtém todas as visitas
        return view('visitas.index', ['visitas' => $visitas]); // Passando diretamente sem compact
    }

    // Exibe o formulário para criar uma nova visita
    public function create()
    {
        return view('visitas.create');
    }

    // Salva a nova visita no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|unique:visitas,matricula',
            'empresa' => 'required|exists:empresas,e_id',
            'seguranca' => 'required|exists:segurancas,s_id',
        ]);

        Visitas::create($request->all());

        return redirect()->route('visitas.index');
    }

    public function edit(Visitas $visita)
    {
        return view('visitas.edit', ['visita' => $visita]); // Passando o objeto Visitas diretamente
    }

   
    public function update(Request $request, Visitas $visita)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'matricula' => 'required|string|unique:visitas,matricula,' . $visita->id,
            'empresa' => 'required|exists:empresas,e_id',
            'seguranca' => 'required|exists:segurancas,s_id',
        ]);

        $visita->update($request->all());

        return redirect()->route('visitas.index');
    }

   
    public function destroy(Visitas $visita)
    {
        $visita->delete();

        return redirect()->route('visitas.index');
    }
}

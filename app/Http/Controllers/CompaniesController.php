<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');  // Captura o valor da pesquisa

        // Criar a consulta de empresas
        $companies = Company::query();

        if ($search) {
            // Filtra pela coluna 'name' (nome)
            $companies = $companies->where('name', 'like', '%' . $search . '%');
        }

        // Recupera as empresas filtradas
        $companies = $companies->get();

        // Retorna a view com as empresas filtradas
        return view('companies.index', ['companies' => $companies]);
    }

    public function create()
    {
        return view('companies.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index');
    }

    public function edit(Company $company)
    {
        return view('companies.form', ['company' => $company]);
    }

    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', ['companies' => $company]);
    }
    // Mostrar empresas presentes
    public function marcarPresenca($id)
    {
        $company = Company::findOrFail($id);
        $company->is_present = !$company->is_present;
        $company->save();
    
        return response()->json([
            'success' => true,
            'is_present' => $company->is_present,
        ]);
    }
    
// Mostrar empresas ausentes
public function ausentes()
{
    $ausentes = Company::where('is_present', false)->get();
    return response()->json($ausentes);
}

// Atualizar status de presença (ativa/desativa)
public function atualizarPresenca($id)
{
    $empresa = Company::findOrFail($id);
    $empresa->is_present = !$empresa->is_present;
    $empresa->save();

    \Log::info('Presença atualizada para a empresa: ' . $empresa->name);

    return response()->json([
        'success' => true,
        'is_present' => $empresa->is_present,
    ]);
}

}

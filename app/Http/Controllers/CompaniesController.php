<?php

namespace App\Http\Controllers;

use App\Models\Company; 
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    
    public function index()
    {
        $companies = Company::all(); 
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
        $company = Company::all();
        return view('visits.form', [
            'companies' => Company::all(),
        ]);

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
}

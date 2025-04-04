<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    // Displays the list of companies
    public function index()
    {
        $companies = Company::all(); // Gets all companies
        return view('companies.index', ['companies' => $companies]);
    }

    // Displays the form to create a new company
    public function create()
    {
        return view('companies.create');
    }

    // Saves the new company to the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index');
    }

    // Displays the edit form
    public function edit(Company $company)
    {
        return view('companies.edit', ['company' => $company]);
    }

    // Updates the company in the database
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $company->update($request->all());

        return redirect()->route('companies.index');
    }

    // Deletes the company from the database
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index');
    }
}

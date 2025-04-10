<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\User;

class VisitsController extends Controller
{
    public function index()
    {
        $visits = Visit::all();

        foreach ($visits as $visit) {
            $visit->company_name = Company::find($visit->company)?->name;
            $visit->user_name = User::find($visit->user)?->name;
        }

        return view('visits.index', ['visits' => $visits]);
    }

    public function create()
    {
        return view('visits.form', [
            'companies' => Company::all(),
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate' => 'required|string',
            'company' => 'required|exists:companies,id',
            'user' => 'required|exists:users,id',
        ]);

        $lisbonTime = new \DateTime('now', new \DateTimeZone('Europe/Lisbon'));

        Visit::create([
            'name' => $request->name,
            'plate' => $request->plate,
            'company' => $request->company,
            'user' => $request->user,
            'entry' => $lisbonTime->format('Y-m-d H:i:s'),
        ]);

        return redirect()->route('visits.index');
    }

    public function edit(Visit $visit)
    {
        return view('visits.form', [
            'visit' => $visit,
            'companies' => Company::all(),
            'users' => User::all(),
        ]); 
    }

    public function update(Request $request, Visit $visit)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'plate' => 'required|string',
            'company' => 'required|exists:companies,id',
            'user' => 'required|exists:users,id',
        ]);

        $visit->update($request->only(['name', 'plate', 'company', 'user']));

        return redirect()->route('visits.index');
    }

    public function destroy(Visit $visit)
    {
        $visit->delete();

        return redirect()->route('visits.index');
    }

    public function markAsExited(Visit $visit)
    {
        $lisbonTime = new \DateTime('now', new \DateTimeZone('Europe/Lisbon'));

        $visit->exit = $lisbonTime->format('Y-m-d H:i:s');
        $visit->save();

        return redirect()->route('visits.index');
    }
    public function show(Visit $visit)
    {
        $visit->company_name = Company::find($visit->company)?->name;
        $visit->user_name = User::find($visit->user)?->name;
        return view('visits.show', ['visit' => $visit]);
    }
}

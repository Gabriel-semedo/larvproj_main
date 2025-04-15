<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $year = $request->input('year');
        $month = $request->input('month');

        $visits = Visit::query();

        if ($search) {
            $visits = $visits->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('plate', 'like', '%' . $search . '%');
            });
        }

        if ($year) {
            $visits = $visits->whereYear('entry', $year);
        }

        if ($month) {
            $visits = $visits->whereMonth('entry', $month);
        }

        $visits = $visits->get();

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

    // Visitas ainda presentes (sem hora de saída)
    public function attendcent()
    {
        $attendcent = Visit::whereNull('exit')->get();
        return view('visits.index', ['visits' => $attendcent]);
    }

    // Visitas ausentes (já saíram)
    public function absents()
    {
        $absents = Visit::whereNotNull('exit')->get();
        return view('visits.index', ['visits' => $absents]);
    }

    // Alterna o estado de saída da visita (AJAX)
    public function togglePresence($id)
    {
        $visit = Visit::findOrFail($id);

        if ($visit->exit === null) {
            $visit->exit = now('Europe/Lisbon')->format('Y-m-d H:i:s');
        } else {
            $visit->exit = null;
        }

        $visit->save();

        return response()->json([
            'success' => true,
            'is_present' => $visit->exit === null,
        ]);
    }
}

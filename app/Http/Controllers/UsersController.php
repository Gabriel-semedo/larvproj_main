<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');  // Captura o valor da pesquisa

        // Criar a consulta de utilizadores
        $users = User::query();

        if ($search) {
            // Filtra pela coluna 'name' (nome)
            $users = $users->where('name', 'like', '%' . $search . '%');
        }

        // Recupera os utilizadores filtrados
        $users = $users->get();

        // Retorna a view com os utilizadores filtrados
        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        return view('users.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        User::create($request->all());

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.form', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', ['user' => $user]);
    }
}

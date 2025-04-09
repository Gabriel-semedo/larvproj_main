@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($user) ? 'Editar Utilizador' : 'Criar Novo Utilizador' }}</h1>

        <!-- Formulário para criar ou editar -->
        <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="POST">
            @csrf
            @isset($user)
                @method('PUT') <!-- Caso seja edição, usa PUT -->
            @endisset

            <div class="form-group">
                <label for="name">Nome de Utilizador</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-success mt-3">
                {{ isset($user) ? 'Atualizar' : 'Criar' }}
            </button>
        </form>
    </div>
@endsection

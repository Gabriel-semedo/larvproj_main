@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Detalhes do Utilizador: {{ $user->name }}</h1>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar à Lista</a>
        </div>

        <!-- Exibir todos os detalhes da empresa -->
        <div class="mb-3">
            <strong>ID:</strong> {{ $user->id }}
        </div>
        <div class="mb-3">
            <strong>Nome:</strong> {{ $user->name }}
        </div>

        <!-- Botões de ação -->
        <div class="mb-3">
            <!-- Editar -->
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-warning">Editar</a>

            <!-- Deletar -->
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja eliminar esta empresa?')">Eliminar</button>
            </form>
        </div>
    </div>
@endsection

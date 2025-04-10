@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Utilizadores</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>

        <!-- Botão para criar uma nova empresa -->
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Novo Utilizador</a>

        <!-- Tabela para exibir as empresas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>
                            <!-- Ver Detalhes -->
                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-info">Ver Detalhes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de empresas</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>

        <!-- Botão para criar uma nova empresa -->
        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Nova Empresa</a>

        <!-- Tabela para exibir as empresas -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>
                            <!-- Editar -->
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            
                            <!-- Deletar -->
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja eliminar esta empresa?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

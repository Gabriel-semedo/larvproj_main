@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Empresas</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>

        <!-- Barra de Pesquisa para Empresas -->
        <form method="GET" action="{{ route('companies.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar empresas por nome" value="{{ request()->input('search') }}">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>

        <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Nova Empresa</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>
                            <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-info">Ver Detalhes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

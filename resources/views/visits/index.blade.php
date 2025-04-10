@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Visitas</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>

        <!-- Barra de Pesquisa para Visitas -->
        <form method="GET" action="{{ route('visits.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar visitas por nome ou matrícula" value="{{ request()->input('search') }}">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
            </div>
        </form>

        <a href="{{ route('visits.create') }}" class="btn btn-primary mb-3">Nova Visita</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td>{{ $visit->name }}</td>
                        <td>{{ $visit->plate }}</td>
                        <td>
                            <a href="{{ route('visits.show', $visit->id) }}" class="btn btn-sm btn-info">Ver Detalhes</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

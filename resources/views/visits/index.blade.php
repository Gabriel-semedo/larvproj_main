@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Visitas</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>
        <form method="GET" action="{{ route('visits.index') }}" class="mb-3">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control w-25" placeholder="Pesquisar visitas por nome ou matrícula" value="{{ request()->input('search') }}">
                <button class="btn btn-success btn-sm" type="submit">Pesquisar</button>
            </div>
            <div class="input-group">
                <select name="month" class="form-control w-25 mx-2">
                    <option value="">Mês</option>
                    <option value="1" {{ request('month') == 1 ? 'selected' : '' }}>Janeiro</option>
                    <option value="2" {{ request('month') == 2 ? 'selected' : '' }}>Fevereiro</option>
                    <option value="3" {{ request('month') == 3 ? 'selected' : '' }}>Março</option>
                    <option value="4" {{ request('month') == 4 ? 'selected' : '' }}>Abril</option>
                    <option value="5" {{ request('month') == 5 ? 'selected' : '' }}>Maio</option>
                    <option value="6" {{ request('month') == 6 ? 'selected' : '' }}>Junho</option>
                    <option value="7" {{ request('month') == 7 ? 'selected' : '' }}>Julho</option>
                    <option value="8" {{ request('month') == 8 ? 'selected' : '' }}>Agosto</option>
                    <option value="9" {{ request('month') == 9 ? 'selected' : '' }}>Setembro</option>
                    <option value="10" {{ request('month') == 10 ? 'selected' : '' }}>Outubro</option>
                    <option value="11" {{ request('month') == 11 ? 'selected' : '' }}>Novembro</option>
                    <option value="12" {{ request('month') == 12 ? 'selected' : '' }}>Dezembro</option>
                </select>
                <input type="text" name="year" class="form-control w-25 mx-2" placeholder="Ano (ex: 2025)" value="{{ request('year') }}">
                <button class="btn btn-primary btn-sm" type="submit">Filtrar</button>
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

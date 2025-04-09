@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Lista de Visitas</h1>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
        </div>

        <a href="{{ route('visits.create') }}" class="btn btn-primary mb-3">Nova Visita</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Empresa</th>
                    <th>Utilizador</th>
                    <th>Entrada</th>
                    <th>Saída</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visits as $visit)
                    <tr>
                        <td>{{ $visit->id }}</td>
                        <td>{{ $visit->name }}</td>
                        <td>{{ $visit->plate }}</td>
                        <td>{{ $visit->company_name ?? '---' }}</td>
                        <td>{{ $visit->user_name ?? '---' }}</td>
                        <td>{{ date('d/m/Y H:i:s', strtotime($visit->entry)) }}</td>
                        <td>
                            {{ $visit->exit ? date('d/m/Y H:i:s', strtotime($visit->exit)) : '---' }}
                        </td>
                        <td>
                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar esta visita?')">Eliminar</button>
                            </form>

                            @if (!$visit->exit)
                                <form action="{{ route('visits.markAsExited', $visit->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Marcar como saída</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

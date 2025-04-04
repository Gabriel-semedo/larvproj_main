@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista de Visitas</h1>

        <a href="{{ route('visits.create') }}" class="btn btn-primary mb-3">Nova Visita</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th> {{-- nova coluna --}}
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
                        <td>{{ $visit->id }}</td> {{-- novo valor --}}
                        <td>{{ $visit->name }}</td>
                        <td>{{ $visit->plate }}</td>
                        <td>{{ $visit->company?->name ?? '---' }}</td>
                        <td>{{ $visit->user?->name ?? '---' }}</td>
                        <td>{{ $visit->entry }}</td>
                        <td>{{ $visit->exit ?? '---' }}</td>
                        <td>
                            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Eliminar esta visita?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

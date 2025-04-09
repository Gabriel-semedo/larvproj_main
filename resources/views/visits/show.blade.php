@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalhes da Visita</h1>

        <div class="mb-4">
            <p><strong>ID:</strong> {{ $visit->id }}</p>
            <p><strong>Nome:</strong> {{ $visit->name }}</p>
            <p><strong>Matrícula:</strong> {{ $visit->plate }}</p>
            <p><strong>Empresa:</strong> {{ $visit->company_name ?? '---' }}</p>
            <p><strong>Utilizador:</strong> {{ $visit->user_name ?? '---' }}</p>
            <p><strong>Entrada:</strong> {{ date('d/m/Y H:i:s', strtotime($visit->entry)) }}</p>
            <p><strong>Saída:</strong> 
                {{ $visit->exit ? date('d/m/Y H:i:s', strtotime($visit->exit)) : '---' }}
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('visits.edit', $visit->id) }}" class="btn btn-warning">Editar</a>

            <form action="{{ route('visits.destroy', $visit->id) }}" method="POST" onsubmit="return confirm('Eliminar esta visita?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Eliminar</button>
            </form>

            @if (!$visit->exit)
                <form action="{{ route('visits.markAsExited', $visit->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success">Marcar como saída</button>
                </form>
            @endif

            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Voltar à Lista</a>
        </div>
    </div>
@endsection

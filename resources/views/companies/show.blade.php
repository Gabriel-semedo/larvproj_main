@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Detalhes da Empresa: {{ $company->name }}</h1>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Voltar à Lista</a>
    </div>

    <!-- Detalhes da Empresa -->
    <div class="card mb-4">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $company->id }}</p>
            <p><strong>Nome:</strong> {{ $company->name }}</p>
        </div>
    </div>

    <!-- Ações -->
    <div class="d-flex gap-2">
        <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">Editar</a>

        <form action="{{ route('companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja eliminar esta empresa?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>
@endsection

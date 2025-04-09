@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($company) ? 'Editar Empresa' : 'Nova Empresa' }}</h1>

        <form action="{{ isset($company) ? route('companies.update', $company->id) : route('companies.store') }}" method="POST">
            @csrf
            @if(isset($company))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ isset($visit) ? 'Editar Visita' : 'Nova Visita' }}</h1>

        <form action="{{ isset($visit) ? route('visits.update', $visit->id) : route('visits.store') }}" method="POST">
            @csrf
            @if(isset($visit))
                @method('PUT')
            @endif

            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $visit->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="plate" class="form-label">Matrícula</label>
                <input type="text" name="plate" class="form-control" value="{{ old('plate', $visit->plate ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Empresa</label>
                <select name="company" class="form-control" required>
                    @foreach(\App\Models\Company::all() as $company)
                        <option value="{{ $company->id }}" {{ old('company', $visit->company ?? '') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user" class="form-label">Utilizador</label>
                <select name="user" class="form-control" required>
                    @foreach(\App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" {{ old('user', $visit->user ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection

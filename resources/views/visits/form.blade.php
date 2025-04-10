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
                    @foreach($companies as $company)
                <option value="{{ $company->id }}" {{ old('company', $visit->company ?? '') == $company->id ? 'selected' : '' }}>
                            {{ $company->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="user" class="form-label">Utilizador</label>
                <select name="user" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user', $visit->user ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Só mostra a data/hora de entrada, se for edição --}}
            @if(isset($visit))
                <div class="mb-3">
                    <label class="form-label">Entrada</label>
                    <input type="text" class="form-control" value="{{ date('d/m/Y H:i:s', strtotime($visit->entry)) }}" disabled>
                </div>
            @endif

            {{-- Se já tiver saída, mostra --}}
            @if(isset($visit) && $visit->exit)
                <div class="mb-3">
                    <label class="form-label">Saída</label>
                    <input type="text" class="form-control" value="{{ date('d/m/Y H:i:s', strtotime($visit->exit)) }}" disabled>
                </div>
            @endif

            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('visits.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>

        {{-- Botão para marcar saída (se ainda não tiver sido marcada) --}}
        @if(isset($visit) && !$visit->exit)
            <form action="{{ route('visits.markAsExited', $visit->id) }}" method="POST" class="mt-3">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-danger">Marcar como saída</button>
            </form>
        @endif
    </div>
@endsection

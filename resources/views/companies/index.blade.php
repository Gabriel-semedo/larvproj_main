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

<head>
    <meta charset="UTF-8">
    <title>Visitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Lista de Empresas</h1>
        <a href="{{ url('/') }}" class="btn btn-secondary">Voltar à Página Principal</a>
    </div>

    <!-- Botões de Filtro -->
    <div class="mb-3 d-flex gap-2">
        <a href="{{ url('/empresas/presentes') }}" class="btn btn-success">Ver Presentes</a>
        <a href="{{ url('/empresas/ausentes') }}" class="btn btn-danger">Ver Ausentes</a>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Ver Todas</a>
    </div>

    <!-- Criar Empresa -->
    <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Nova Empresa</a>

    <!-- Tabela -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Presença</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>

                    <td>
                        @if ($company->is_present)
                            <span class="badge bg-success">Presente</span>
                        @else
                            <span class="badge bg-danger">Ausente</span>
                        @endif
                    </td>

                    <td class="d-flex gap-2">
                        <a href="{{ route('companies.show', $company->id) }}" class="btn btn-sm btn-info">Ver Detalhes</a>

                        <button type="button" 
                            class="btn btn-sm toggle-presenca {{ $company->is_present ? 'btn-danger' : 'btn-success' }}" 
                            data-id="{{ $company->id }}">
                            {{ $company->is_present ? 'Marcar como Ausente' : 'Marcar como Presente' }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {
    $('.toggle-presenca').click(function () {
        const button = $(this);
        const companyId = button.data('id');

        $.ajax({
            url: `/empresas/${companyId}/presenca`,
            type: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}',
            },
            success: function (response) {
                if (response.success) {
                    if (response.is_present) {
                        button.removeClass('btn-success').addClass('btn-danger');
                        button.text('Marcar como Ausente');
                        button.closest('tr').find('td:nth-child(2)').html('<span class="badge bg-success">Presente</span>');
                    } else {
                        button.removeClass('btn-danger').addClass('btn-success');
                        button.text('Marcar como Presente');
                        button.closest('tr').find('td:nth-child(2)').html('<span class="badge bg-danger">Ausente</span>');
                    }
                } else {
                    alert('Erro ao atualizar presença.');
                }
            },
            error: function () {
                alert('Erro ao atualizar presença.');
            }
        });
    });
});
</script>

@endsection

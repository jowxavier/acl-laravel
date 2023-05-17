@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.tenants.index') }}" class="active">Empresas</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
        <h1><a href="{{ route('admin.tenants.create') }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.tenants.search') }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Empresa</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            <td><img src="{{ $tenant->logo }}" alt="{{ $tenant->company }}" style="max-width: 90px;"></td>
                            <td>{{ $tenant->company }}</td>
                            <td>
                                <a href="{{ route('admin.tenants.show', $tenant->id) }}" title="Detalhes" class="btn btn-light"><i class="fas fa-fw fa-search"></i></a>
                                @if($tenant->id !== auth()->user()->tenant->id)
                                    <a href="{{ route('admin.tenants.sigin', $tenant->id) }}" title="Logar" class="btn btn-warning"><i class="fas fa-fw fa-share"></i></a>
                                @endif
                            </td>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $tenants->appends($filters)->links() !!}
                            @else
                                {!! $tenants->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

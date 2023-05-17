@extends('adminlte::page')

@section('title', "Permissões relacionadas o Cargo {$role->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.roles.index') }}" class="active">Perfis</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.roles.permissions.index', $role->id) }}" class="active">Permissões</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Permissões relacionadas o Cargo <strong>{{ $role->name }}</strong></h1>
            <h1><a href="{{ route('admin.roles.permissions.create', $role->id) }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.roles.permissions.search', $role->id) }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <form action="{{ route('admin.roles.permissions.destroy', [$role->id, $permission->id]) }}" class="form" method="POST">
                            @csrf
                            @method('DELETE')

                            <tr>
                                <td>{{ $permission->description }}</td>
                                <td><button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                        </form>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $permissions->appends($filters)->links() !!}
                            @else
                                {!! $permissions->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

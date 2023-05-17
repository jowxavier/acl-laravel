@extends('adminlte::page')

@section('title', "Cargos relacionados ao Usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}" class="active">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.roles.index', $user->id) }}" class="active">Permissões</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Cargos relacionados ao Usuário <strong>{{ $user->name }}</strong></h1>
            <h1><a href="{{ route('admin.users.roles.create', $user->id) }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.users.roles.search', $user->id) }}" method="POST" class="form form-inline">
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
                        <th>Descrição</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <form action="{{ route('admin.users.roles.destroy', [$user->id, $role->id]) }}" class="form" method="POST">
                            @csrf
                            @method('DELETE')

                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                                <td>
                                    @if(!$role->manager)
                                        <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                    @endif
                                </td>
                            </tr>
                        </form>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $roles->appends($filters)->links() !!}
                            @else
                                {!! $roles->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

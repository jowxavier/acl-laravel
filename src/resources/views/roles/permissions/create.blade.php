@extends('adminlte::page')

@section('title', "Permissões não relacionadas o Cargo {$role->name}")

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
            <h1>Permissões não relacionadas o Cargo <strong>{{ $role->name }}</strong></h1>
            <form action="{{ route('admin.roles.permissions.create.search', $role->id) }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.roles.permissions.store', $role->id) }}" class="form" method="POST">
                        @csrf

                        @foreach ($permissions as $permission)
                            <tr>
                                <td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}"></td>
                                <td>{{ $permission->description }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-dark">Gravar</button></td>
                        </tr>
                    </form>
                    <tr>
                        <td colspan="2">
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

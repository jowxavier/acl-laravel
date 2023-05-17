@extends('adminlte::page')

@section('title', "Cargos não relacionadas ao Usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}" class="active">Usuários</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.roles.index', $user->id) }}" class="active">Cargos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Cargos não relacionadas ao Usuário <strong>{{ $user->name }}</strong></h1>
            <form action="{{ route('admin.users.roles.create.search', $user->id) }}" method="POST" class="form form-inline">
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
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.users.roles.store', $user->id) }}" class="form" method="POST">
                        @csrf

                        @foreach ($roles as $role)
                            <tr>
                                <td><input type="checkbox" name="roles[]" value="{{ $role->id }}"></td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->description }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-dark">Gravar</button></td>
                        </tr>
                    </form>
                    <tr>
                        <td colspan="2">
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

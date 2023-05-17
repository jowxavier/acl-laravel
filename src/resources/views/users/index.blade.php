@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}" class="active">Usuários</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1><a href="{{ route('admin.users.create') }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.users.search') }}" method="POST" class="form form-inline">
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
                        <th>Email</th>
                        <th>Empresa</th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->tenant->company }}</td>
                            <td><a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-light"><i class="fas fa-fw fa-search "></i></a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $users->appends($filters)->links() !!}
                            @else
                                {!! $users->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.permissions.index') }}" class="active">Permissões</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{ route('admin.permissions.search') }}" method="POST" class="form form-inline">
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->description }}</td>
                        </tr>
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

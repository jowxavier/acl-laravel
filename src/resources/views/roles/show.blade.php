@extends('adminlte::page')

@section('title', "Detalhes do Cargo {$role->name}")

@section('content_header')
    <h1>Detalhes do Cargo <strong>{{ $role->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome</strong> {{ $role->name }}
                </li>
                <li>
                    <strong>Descrição</strong> {{ $role->description }}
                </li>
            </ul>

            <form action="{{ route('admin.roles.destroy', $role->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')

                <a href="{{ route('admin.roles.permissions.index', $role->id) }}" title="Permissões" class="btn btn-primary"><i class="fas fa-fw fa-key"></i></a>
                <a href="{{ route('admin.roles.edit', $role->id) }}" title="Editar" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
@stop

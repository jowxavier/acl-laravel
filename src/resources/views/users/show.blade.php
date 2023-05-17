@extends('adminlte::page')

@section('title', "Detalhes do usuario {$user->name}")

@section('content_header')
    <h1>Detalhes do usuario <strong>{{ $user->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome</strong> {{ $user->name }}
                </li>
                <li>
                    <strong>Email</strong> {{ $user->email }}
                </li>
            </ul>

            <form action="{{ route('admin.users.destroy', $user->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')

                <a href="{{ route('admin.users.roles.index', $user->id) }}" title="Cargos" class="btn btn-primary"><i class="fas fa-fw fa-user-tag"></i></a>
                <a href="{{ route('admin.users.edit', $user->id) }}" title="Editar" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
@stop
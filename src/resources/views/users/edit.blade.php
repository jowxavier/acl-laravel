@extends('adminlte::page')

@section('title', "Editar o Usuário {$user->name}")

@section('content_header')
    <h1>Editar o Usuário <strong>{{ $user->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include("users.form")
            </form>
        </div>
    </div>
@stop
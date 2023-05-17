@extends('adminlte::page')

@section('title', 'Cadastrar Novo Usuário')

@section('content_header')
    <h1>Cadastrar Novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.store') }}" class="form" method="POST">
                @csrf

                @include("users.form")
            </form>
        </div>
    </div>
@stop
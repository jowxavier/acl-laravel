@extends('adminlte::page')

@section('title', 'Cadastrar Novo Cargo')

@section('content_header')
    <h1>Cadastrar Novo Cargo</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.store') }}" class="form" method="POST">
                @csrf

                @include("roles.form")
            </form>
        </div>
    </div>
@stop
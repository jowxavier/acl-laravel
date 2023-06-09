@extends('adminlte::page')

@section('title', 'Cadastrar Nova Categoria')

@section('content_header')
    <h1>Cadastrar Nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" class="form" method="POST">
                @csrf

                @include("categories.form")
            </form>
        </div>
    </div>
@stop
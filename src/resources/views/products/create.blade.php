@extends('adminlte::page')

@section('title', 'Cadastrar Novo Produto')

@section('content_header')
    <h1>Cadastrar Novo Produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include("products.form")
            </form>
        </div>
    </div>
@stop
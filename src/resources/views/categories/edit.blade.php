@extends('adminlte::page')

@section('title', "Editar o Categoria {$category->name}")

@section('content_header')
    <h1>Editar o Categoria <strong>{{ $category->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include("categories.form")
            </form>
        </div>
    </div>
@stop
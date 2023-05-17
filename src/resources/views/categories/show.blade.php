@extends('adminlte::page')

@section('title', "Detalhes da categoria {$category->name}")

@section('content_header')
    <h1>Detalhes da categoria <strong>{{ $category->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <strong>Nome</strong> {{ $category->name }}
                </li>
                <li>
                    <strong>URL</strong> {{ $category->url }}
                </li>
            </ul>

            <form action="{{ route('admin.categories.destroy', $category->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')

                <a href="{{ route('admin.categories.edit', $category->id) }}" title="Editar" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
@stop
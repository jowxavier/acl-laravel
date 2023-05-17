@extends('adminlte::page')

@section('title', "Detalhes do produto {$product->name}")

@section('content_header')
    <h1>Detalhes do produto <strong>{{ $product->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img src="{{ $product->path }}" alt="{{ $product->name }}" style="max-width: 90px;">
                </li>
                <li>
                    <strong>Nome</strong> {{ $product->name }}
                </li>
                <li>
                    <strong>Descrição</strong> {{ $product->description }}
                </li>
            </ul>

            <form action="{{ route('admin.products.destroy', $product->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')

                <a href="{{ route('admin.products.categories.index', $product->id) }}" title="Categorias" class="btn btn-primary"><i class="fas fa-layer-group"></i></a>
                <a href="{{ route('admin.products.edit', $product->id) }}" title="Editar" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
@stop
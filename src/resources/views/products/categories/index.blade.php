@extends('adminlte::page')

@section('title', "Categorias relacionadas ao Produto {$product->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}" class="active">Produtos</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.products.categories.index', $product->id) }}" class="active">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1>Categorias relacionadas ao Produto <strong>{{ $product->name }}</strong></h1>
            <h1><a href="{{ route('admin.products.categories.create', $product->id) }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.products.categories.search', $product->id) }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="100px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <form action="{{ route('admin.products.categories.destroy', [$product->id, $category->id]) }}" class="form" method="POST">
                            @csrf
                            @method('DELETE')

                            <tr>
                                <td>{{ $category->name }}</td>
                                <td><button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button></td>
                            </tr>
                        </form>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $categories->appends($filters)->links() !!}
                            @else
                                {!! $categories->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop
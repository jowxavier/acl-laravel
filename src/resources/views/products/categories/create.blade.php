@extends('adminlte::page')

@section('title', "Categorias não relacionadas ao Produto {$product->name}")

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
            <h1>Categorias não relacionadas ao Produto <strong>{{ $product->name }}</strong></h1>
            <form action="{{ route('admin.products.categories.create.search', $product->id) }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th width="50px">#</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <form action="{{ route('admin.products.categories.store', $product->id) }}" class="form" method="POST">
                        @csrf

                        @foreach ($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="categories[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"><button type="submit" class="btn btn-dark">Gravar</button></td>
                        </tr>
                    </form>
                    <tr>
                        <td colspan="2">
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
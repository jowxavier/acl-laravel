@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.products.index') }}" class="active">Produtos</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1><a href="{{ route('admin.products.create') }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.products.search') }}" method="POST" class="form form-inline">
                @csrf

                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{ $filters['filter'] ?? '' }}">&nbsp;
                <button type="submit" class="btn btn-dark">Filtrar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Nome</th>
                        <th>Empresa</th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td><img src="{{ $product->path }}" alt="{{ $product->name }}" style="max-width: 90px;"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->tenant->company }}</td>
                            <td><a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-light"><i class="fas fa-fw fa-search "></i></a></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            @if (isset($filters))
                                {!! $products->appends($filters)->links() !!}
                            @else
                                {!! $products->links() !!}
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop

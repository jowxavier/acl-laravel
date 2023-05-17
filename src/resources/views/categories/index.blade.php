@extends('adminlte::page')

@section('title', 'Categorias')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('admin.categories.index') }}" class="active">Categorias</a></li>
    </ol>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h1><a href="{{ route('admin.categories.create') }}" class="btn btn-dark">Adicionar</a></h1>
            <form action="{{ route('admin.categories.search') }}" method="POST" class="form form-inline">
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
                        <th>URL</th>
                        <th>Empresa</th>
                        <th width="10px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->url }}</td>
                            <td>{{ $category->tenant->company }}</td>
                            <td><a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-light"><i class="fas fa-fw fa-search "></i></a></td>
                        </tr>
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

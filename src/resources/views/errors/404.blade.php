@extends('adminlte::page')

@section('title', 'Página de Erro')

@section('content_header')
    <h1>Página de Erro</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="error-page">
                <h2 class="headline text-yellow"> 404</h2>
                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Página não existe</h3>
                    <p>
                        Não possível encontrar a página que você estava procurando. Por favor <a href="{{ route('admin.dashboard') }}">retornar ao dashboard</a>.
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop



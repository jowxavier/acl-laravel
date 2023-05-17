@extends('adminlte::page')

@section('title', 'Cadastrar Nova Empresa')

@section('content_header')
    <h1>Cadastrar Nova Empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tenants.store') }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf

                @include("tenants.form")
            </form>
        </div>
    </div>
@stop
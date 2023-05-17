@extends('adminlte::page')

@section('title', "Editar a Empresa {$tenant->name}")

@section('content_header')
    <h1>Editar a Empresa <strong>{{ $tenant->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tenants.update', $tenant->id) }}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include("tenants.form")
            </form>
        </div>
    </div>
@stop
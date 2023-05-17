@extends('adminlte::page')

@section('title', "Editar o Cargo {$role->name}")

@section('content_header')
    <h1>Editar o Cargo <strong>{{ $role->name }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.update', $role->id) }}" class="form" method="POST">
                @csrf
                @method('PUT')

                @include("roles.form")
            </form>
        </div>
    </div>
@stop
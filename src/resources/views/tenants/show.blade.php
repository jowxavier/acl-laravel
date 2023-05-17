@extends('adminlte::page')

@section('title', "Detalhes do produto {$tenant->company}")

@section('content_header')
    <h1>Detalhes do produto <strong>{{ $tenant->company }}</strong></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li>
                    <img src="{{ $tenant->logo }}" alt="{{ $tenant->company }}" style="max-width: 90px;">
                </li>
                <li>
                    <strong>Empresa</strong> {{ $tenant->company }}
                </li>
                <li>
                    <strong>Email</strong> {{ $tenant->email }}
                </li>
            </ul>

            <form action="{{ route('admin.tenants.destroy', $tenant->id) }}" class="form" method="POST">
                @csrf
                @method('DELETE')

                @if($tenant->id !== auth()->user()->tenant->id)
                    <a href="{{ route('admin.tenants.sigin', $tenant->id) }}" title="Logar" class="btn btn-warning"><i class="fas fa-fw fa-share"></i></a>
                @endif
                <a href="{{ route('admin.tenants.edit', $tenant->id) }}" title="Editar" class="btn btn-info"><i class="fas fa-edit"></i></a>
                <button type="submit" title="Remover" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
            </form>
        </div>
    </div>
@stop

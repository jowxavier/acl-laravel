@extends('adminlte::page')

@section('title', 'Dashboard Acl')

@section('content')
<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-users"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Usuários</span>
                <span class="info-box-number">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-building"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Empresas</span>
                <span class="info-box-number">{{ $totalTenants }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-address-card"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Cargos</span>
                <span class="info-box-number">{{ $totalRoles }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-key"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Permissões</span>
                <span class="info-box-number">{{ $totalPermissions }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-fw fa-tags"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Categorias</span>
                <span class="info-box-number">{{ $totalCategories }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua">
                <i class="fas fa-fw fa-gifts"></i>
            </span>

            <div class="info-box-content">
                <span class="info-box-text">Produtos</span>
                <span class="info-box-number">{{ $totalProducts }}</span>
            </div>
        </div>
    </div>
@stop

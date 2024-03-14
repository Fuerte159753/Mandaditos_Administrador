<!-- resources/views/admin/inicio.blade.php -->

@extends('layouts.admin_layout')

@section('title', 'Inicio')

@section('content')
<!--aqui va el contenido de la pagina -->
    <h1 class="mt-4">Bienvenido al panel de administración</h1>
    <p>Revisa algunas estadisticas de la aplicacion 😉.</p>
    <div class="content-grande" style="display: flex">
        <div class="content-int" style="width: 50%">
            <span style="color: green">1</span>
            <p>pedidos realizados el dia de hoy</p>
        </div>
        <div class="content-int" style="width: 50%">
            <span style="color: yellow">2</span>
            <p>pedidos pendientes de entrega</p>
        </div>
    </div>
    <div class="content-grande" style="display: flex">
        <div class="content-int" style="width: 50%">
            <span style="color: blue">1</span>
            <p>Repartidores en ruta en estos momentos</p>
        </div>
        <div class="content-int" style="width: 50%">
            <span style="color: red">3</span>
            <p>Pedidos cancelados</p>
        </div>
    </div>
@endsection
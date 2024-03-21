@extends('layouts.admin_layout')
@section('title', 'Inicio')
@section('content')
     <center>   <h1 class="mt-4">Bienvenido al panel de administración</h1>
    <p>Revisa algunas estadisticas de la aplicacion 😉.</p>
    <br><br>
    <div class="content-grande" style="display: flex">
        
        <div class="content-int" style="width: 50%">
            <div style="text-align: center">
                <div style="height: 100px; width:auto;">
                    <a href="" style="text-decoration: none">
                        <span style="color: green; font-size: 500%">0</span>
                    </a>
                </div>
                <div>
                    <p>Pedidos realizados hoy</p>
                </div>
            </div>
        </div>

        <div class="content-int" style="width: 50%">
            <div style="text-align: center">
                <div style="height: 100px; width:auto;">
                    <a href="" style="text-decoration: none">
                        <span style="color: yellow; font-size: 500%">0</span>
                    </a>
                </div>
                <div>
                    <p>Pendientes de Entrega</p>
                </div>
            </div>
        </div>
    </div>

    <div class="content-grande" style="display: flex">

        <div class="content-int" style="width: 50%">
            <div style="text-align: center">
                <div style="height: 100px; width:auto;">
                    <a href="" style="text-decoration: none">
                        <span style="color: blue; font-size: 500%">0</span>
                    </a>
                </div>
                <div>
                    <p>Repartidores en ruta</p>
                </div>
            </div>
        </div>


        <div class="content-int" style="width: 50%">
            <div style="text-align: center">
                <div style="height: 100px; width:auto;">
                    <a href="" style="text-decoration: none">
                        <span style="color: red; font-size: 500%">0</span>
                    </a>
                </div>
                <div>
                    <p>Pedidos Cancelados</p>
                </div>
            </div>
        </div>
    </div></center>
<br><br>
@endsection
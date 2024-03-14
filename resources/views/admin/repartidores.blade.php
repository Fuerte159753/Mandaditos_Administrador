<!-- resources/views/admin/inicio.blade.php -->
@extends('layouts.admin_layout')

@section('title', 'Repartidores')

@section('content')
<!--aqui va el contenido de la pagina -->
    <h1 class="mt-4">Repartidores</h1>
        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($repartidores as $repartidor)
                        <tr>
                            <td>{{ $repartidor->nombre }}</td>
                            <td>{{ $repartidor->apellido }}</td>
                            <td>{{ $repartidor->telefono }}</td>
                            <td>{{ $repartidor->correo }}</td>
                             <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" >
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                                <button class="btn btn-danger btn-eliminar">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
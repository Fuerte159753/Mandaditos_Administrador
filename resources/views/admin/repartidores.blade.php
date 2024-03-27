<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@extends('layouts.admin_layout')
@section('title', 'Repartidores')
@section('content')
<style>
    #btnAgregarRepartidor {
        position: fixed;
        top: 20%;
        right: 7%;
        z-index: 9999;
    }
    #btnAgregarRepartidor i {
        font-size: 200%;
    }
</style>
    <h1 class="mt-4">Repartidores</h1>
    <div style="width: 50%; margin: auto;">
        <div class="input-group input-group-sm">
            <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                </svg>
            </span>
            <input id="searchInput" type="text" class="form-control form-control-sm" placeholder="Buscar Por:" aria-label="Input group example" aria-describedby="basic-addon1">
        </div>
    </div> 
    <br>
    <button id="btnAgregarRepartidor" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAgregarRepartidor" title="Agregar Repartidor">
        <i class="bi bi-plus-circle"></i>
    </button>
    <br>
    <div class="table-responsive">
        <table id="tabla-repartidores" class="table table-striped text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Username</th>
                    <th>Teléfono</th>
                    <th>Correo</th>
                    <th>Ruta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1 @endphp
                @foreach($repartidores as $repartidor)
                    <tr>
                        <td>{{ $contador }}</td>
                        <td>{{ $repartidor->nombre }}</td>
                        <td>{{ $repartidor->apellido }}</td>
                        <td>{{ $repartidor->username}}</td>
                        <td>{{ $repartidor->telefono }}</td>
                        <td>{{ $repartidor->correo }}</td>
                        <td>{{ $repartidor->ruta_asignada }}</td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editrepar{{ $repartidor->repartidor_id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-eliminar" data-repartidor-id="{{ $repartidor->repartidor_id }}">
                                <i class="bi bi-trash"></i>
                            </button>  
                        </td>
                    </tr>
                    @php $contador++ @endphp
                @endforeach
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul id="pagination" class="pagination justify-content-end">
                <li class="page-item disabled" id="previous">
                    <a class="page-link">Previous</a>
                </li>
            </ul>
        </nav>
    </div>    
</div>
<br><br><br><br><br><br>
@endsection
@foreach($repartidores as $repartidor)
    <div class="modal fade" id="editrepar{{ $repartidor->repartidor_id }}" tabindex="-1" aria-labelledby="editrepar{{ $repartidor->repartidor_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editrepar{{ $repartidor->repartidor_id }}Label">Editar a {{$repartidor->nombre}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.updarepar', ['repartidor_id' => $repartidor->repartidor_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $repartidor->nombre }}">
                        </div><div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $repartidor->username }}">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $repartidor->apellido }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $repartidor->telefono }}">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $repartidor->correo }}">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div></form>
            </div>
        </div>
    </div>
@endforeach
@if(session('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    </script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    var numRepartidores = {{ count($repartidores) }};
    var numPaginas = Math.ceil(numRepartidores / 10);
    
    var paginationHTML = '';
    for (var i = 1; i <= numPaginas; i++) {
        paginationHTML += '<li class="page-item"><a class="page-link" href="#">' + i + '</a></li>';
    }
    $('#pagination').append(paginationHTML);
    
    if (numPaginas <= 1) {
        $('#pagination').hide();
    }
    
    $('#pagination').on('click', 'li.page-item', function() {
        var page = $(this).text();
    });

    $('#searchInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        $('#tabla-repartidores tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    $('.btn-eliminar').click(function() {
        var repartidorId = $(this).data('repartidor-id');
        
        var currentUrl = window.location.href;

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se podra deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/repartidores/'+ repartidorId+'/eliminar' ,
                    type: 'delete',
                    success: function(response) {
                        console.log('repartidor eliminado correctamente');
                        window.location.href = currentUrl;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar repartidor:', error);
                    }
                });
            }
        });
    });
});
</script>
<!-- Modal Agregar Repartidor -->
<div class="modal fade" id="modalAgregarRepartidor" tabindex="-1" aria-labelledby="modalAgregarRepartidorLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarRepartidorLabel">Agregar Repartidor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.registrarRepartidor') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de usuario</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="ruta_asignada" class="form-label">Ruta asignada</label>
                        <select class="form-select" id="ruta_asignada" name="ruta_asignada" required>
                            <option value="">Selecciona una ruta</option>
                            @foreach($rutas as $ruta)
                                <option value="{{ $ruta->id }}">{{ $ruta->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


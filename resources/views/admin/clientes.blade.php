<link rel="icon" type="image/png" href="{{ asset('resourses/iconpes.png') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
@extends('layouts.admin_layout')
@section('title', 'Clientes')
@section('content')
    <h1 class="mt-4">Clientes</h1>
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
        <br>
        <div class="table-responsive">
            <table id="tabla-clientes" class="table table-striped text-center">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Localidad</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Verificado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php $contador = 1 @endphp 
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->localidad }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->correo }}</td>
                            <td style="background-color: {{ $cliente->verificado == 0 ? 'lightgreen' : 'lightcoral' }}">
                                {{ $cliente->verificado == 0 ? 'Verificado' : 'No Verificado' }}
                        	</td>
                            <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarClienteModal{{ $cliente->cliente_id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-danger btn-eliminar" data-cliente-id="{{ $cliente->cliente_id }}">
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
    <br><br><br>
@foreach($clientes as $cliente)
    <div class="modal fade" id="editarClienteModal{{ $cliente->cliente_id }}" tabindex="-1" aria-labelledby="editarClienteModal{{ $cliente->cliente_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarClienteModal{{ $cliente->cliente_id }}Label">Editar a {{$cliente->nombre}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.actualizarCliente', ['cliente_id' => $cliente->cliente_id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $cliente->apellido }}">
                        </div>
                        <div class="mb-3">
                            <label for="localidad" class="form-label">Localidad</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" value="{{ $cliente->localidad }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $cliente->correo }}">
                        </div>
                        <div class="mb-3">
                            <label for="verificado" class="form-label">Verificado</label>
                            <select class="form-select" id="verificado" name="verificado">
                                <option value="0" {{ $cliente->verificado == 0 ? 'selected' : '' }}>Verificado</option>
                                <option value="1" {{ $cliente->verificado == 1 ? 'selected' : '' }}>No verificado</option>
                            </select>
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
    var numClientes = {{ count($clientes) }};
    var numPaginas = Math.ceil(numClientes / 10);
    
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
        $('#tabla-clientes tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    $('.btn-eliminar').click(function() {
        // Obtener el ID del cliente a eliminar desde el atributo data
        var clienteId = $(this).data('cliente-id');
        
        // Guardar la URL actual
        var currentUrl = window.location.href;

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/clientes/' + clienteId+'/eliminar' ,
                    type: 'delete',
                    success: function(response) {
                        console.log('Cliente eliminado correctamente');
                        console.log(url);
                        window.location.href = currentUrl;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al eliminar cliente:', error);
                        window.location.href = currentUrl;
                    }
                });
            }
        });
    });
});

</script>
@endsection
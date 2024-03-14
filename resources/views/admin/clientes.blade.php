<!-- resources/views/admin/clientes.blade.php -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="icon" type="image/png" href="{{ asset('resourses/iconpes.png') }}">
@extends('layouts.admin_layout')
@section('title', 'Clientes')
@section('content')
    <h1 class="mt-4">Clientes</h1>
    <div class="mb-3 d-flex">
        <input type="text" class="form-control me-2" id="busqueda" placeholder="Buscar...">
        <select class="form-select me-2" id="campo">
            <option value="nombre">Nombre</option>
            <option value="apellido">Apellido</option>
            <option value="localidad">Localidad</option>
            <option value="correo">Correo</option>
        </select>
        <button class="btn btn-primary" id="btnBuscar">Buscar</button>
    </div>

        <div class="table-responsive">
            <table class="table table-striped text-center">
                <thead>
                    <tr>
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
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->localidad }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->correo }}</td>
                            <td style="background-color: {{ $cliente->verificado == 1 ? 'lightgreen' : 'lightcoral' }}">
                                {{ $cliente->verificado == 1 ? 'Verificado' : 'No Verificado' }}
                        	 </td>
                             <td>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarClienteModal{{ $cliente->cliente_id }}">
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
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                  <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
              </nav>
        </div>
    </div>
@endsection
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
                                <option value="1" {{ $cliente->verificado == 1 ? 'selected' : '' }}>Verificado</option>
                                <option value="0" {{ $cliente->verificado == 0 ? 'selected' : '' }}>No verificado</option>
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
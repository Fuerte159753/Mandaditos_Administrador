<link rel="icon" type="image/png" href="{{ asset('resourses/iconpes.png') }}">
@extends('layouts.admin_layout')

@section('title', 'Vendedores')

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
    <h1 class="mt-4">vendedores</h1>
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
                    <th>Establecimiento</th>
                    <th>Username</th>
                    <th>Correo</th>
                    <th>Teléfono</th>
                    <th>Verificado</th>
                    <th>Código de Verificación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1 @endphp
                @foreach($vendedores as $vendedor)
                <tr>
                    <td>{{ $contador }}</td>
                    <td>{{ $vendedor->nombre_establecimiento }}</td>
                    <td>{{ $vendedor->username }}</td>
                    <td>{{ $vendedor->correo }}</td>
                    <td>{{ $vendedor->telefono }}</td>
                    <td style="background-color: {{ $cliente->verificado == 1 ? 'lightgreen' : 'lightcoral' }}">
                        {{ $cliente->verificado == 1 ? 'Verificado' : 'No Verificado' }}
                    </td>
                    <td>{{ $vendedor->codigo_verificacion ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editvend{{ $vendedor->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button class="btn btn-danger btn-eliminar" data-vendedor-id="{{ $vendedor->id }}">
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
<br><br><br><br><br><br><br><br>
@foreach($vendedores as $vendedor)
    <div class="modal fade" id="editvend{{ $vendedor->id }}" tabindex="-1" aria-labelledby="editvend{{ $vendedor->id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editvend{{ $vendedor->id }}Label">Editar a {{$vendedor->nombre_establecimiento}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $vendedor->nombre_establecimiento }}">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ $vendedor->username }}">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="{{ $vendedor->correo }}">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $vendedor->telefono }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
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
<!-- Modal Agregar Repartidor -->
<div class="modal fade" id="modalAgregarRepartidor" tabindex="-1" aria-labelledby="modalAgregarRepartidorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAgregarRepartidorLabel">Agregar Vendedor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nombre_establecimiento" class="form-label">Nombre del establecimiento</label>
                        <input type="text" placeholder="Nombre del establecimiento" class="form-control" id="nombre_establecimiento" name="nombre_establecimiento" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" placeholder="Nombre de usuario" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="example@algun.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
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

@endsection
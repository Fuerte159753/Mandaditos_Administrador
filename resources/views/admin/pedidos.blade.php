<script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@extends('layouts.admin_layout')
@section('title', 'Repartidores')
@section('content')
<h1 class="mt-4">Pedidos</h1>
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
                    <th>Fecha del pedido</th>
                    <th>Direccion</th>
                    <th>Descripcion</th>
                    <th>Cantidad</th>
                    <th>Estado Pedido</th>
                    <th>cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php $contador = 1 @endphp 
                @foreach($pedidos as $pedido)
                    <tr>
                        <td>{{ $contador }}</td>
                        <td>{{ $pedido->fecha_pedido }}</td>
                        <td>{{ $pedido->direccion }}</td>
                        <td>{{ $pedido->descripcion }}</td>
                        <td>{{ $pedido->cantidad }}</td>
                        <td style="background-color:
                            @if($pedido->estado_pedido == 'entregado')
                                #2ECC71
                            @elseif($pedido->estado_pedido == 'pendiente')
                                #2D76FF
                            @elseif($pedido->estado_pedido == 'en espera')
                                #F1C40F
                            @elseif($pedido->estado_pedido == 'cancelado')
                                #F73434
                            @endif;">{{ $pedido->estado_pedido}}
                        </td>
                        <td>{{$pedido->cliente_id}}</td>
                        <td>
                            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarPedidoModal{{ $pedido->pedido_id }}">
                                <i class="bi bi-pencil-square"></i>
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
@foreach($pedidos as $pedido)
    <div class="modal fade" id="editarPedidoModal{{ $pedido->pedido_id }}" tabindex="-1" aria-labelledby="editarPedidoModal{{ $pedido->pedido_id }}Label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarClienteModal{{ $pedido->pedido_id }}Label">Editar a Pedido n{{$pedido->pedido_id}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                        @method('PUT')
                        <div class="mb-3">
                            <label for="verificado" class="form-label">Verificado</label>
                            <select class="form-select" id="verificado" name="verificado">
                                <option value="en espera" {{ $pedido->estado_pedido == 'en espera' ? 'selected' : '' }}>En espera</option>
                                <option value="entregado" {{ $pedido->estado_pedido == 'entregado' ? 'selected' : '' }}>Entregado</option>
                                <option value="pendiente" {{ $pedido->estado_pedido == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="cancelado" {{ $pedido->estado_pedido == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
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
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/png" href="{{ asset('resourses/iconpes.png') }}">
    <style>
        .btn-custom {
            background-color: #007bff;
            color: #fff;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #0056b3;
            color: #fff;
        }
        .btn-custom.active {
            background-color: #28a745;
        }
        .btn-logout {
            background-color: transparent;
            color: #050505;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-logout:hover {
            background-color: #dc3545;
            color: #fff;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Bienvenido {{ session('name') }} {{ session('lastName') }}</span>
            <div class="d-flex">
                <!-- Botones -->
                <a href="{{ route('admin.inicio') }}" class="navbar-brand {{ request()->routeIs('admin.inicio') ? 'active' : '' }}">Inicio</a>
                <a href="{{ route('admin.clientes') }}" class="btn btn-custom mx-2 {{ request()->routeIs('admin.clientes') ? 'active' : '' }}">Clientes</a>
                <a href="{{ route('admin.repartidor')}}" class="btn btn-custom mx-2 {{ request()->routeIs('admin.repartidor') ? 'active' : '' }}">Repartidores</a>
                <a href="{{ route('admin.vendedores')}}" class="btn btn-custom mx-2 {{ request()->routeIs('admin.vendedores') ? 'active' : '' }}">Vendedores</a>
                
                <!-- Menú desplegable -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('admin.perfil')}}">Ver perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item btn-logout" href="#">Cerrar sesión <i class="bi bi-box-arrow-left"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    
    <footer class="footer">
        <img src="{{ asset('resourses/iconpes.png') }}" alt="Icono" style="width: 50px; height: 50px;">
        <p>Mandaditos Xhate</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
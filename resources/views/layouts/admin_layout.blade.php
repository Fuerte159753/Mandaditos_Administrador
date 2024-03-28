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
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
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
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 80px;
            background-color: #343a40;
            color: #ffffff;
            text-align: center;
            padding: 10px 0;
        }
        .container {
            padding-left: 4%;
        }
        .off:hover {
            background-color: #00c36e;
            color: #ffffff;
        }
        .navbar{
            border-bottom: solid 1px rgb(121, 121, 121);
            background-color: #343a40;
        }
        .navbar-brand{
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="d-flex flex-column flex-shrink-0 bg-shadow" style="width: 4.5rem; height: 100vh; position: fixed; lefth: 0; top: 0; z-index: 1;">
        <a class="d-block p-3 link-dark text-decoration-none" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
          <svg class="bi" width="30" height="32"><use xlink:href="#bootstrap"></use></svg>
          <span class="visually-hidden">Icon-only</span>
        </a>
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center">
          <li class="nav-item">
            <a href="{{ route('admin.inicio') }}" class="nav-link {{ request()->routeIs('admin.inicio') ? 'active' : '' }} py-3 border-bottom" aria-current="page" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Inicio">
                <i class="bi bi-house-door"></i>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.clientes') }}" class="nav-link {{ request()->routeIs('admin.clientes') ? 'active' : '' }} py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Clientes">
                <i class="bi bi-person-lines-fill"></i>
            </a>            
          </li>
          <li>
            <a href="{{ route('admin.repartidor') }}" class="nav-link {{ request()->routeIs('admin.repartidor') ? 'active' : '' }} py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Repartidores">
                <i class="bi bi-truck"></i>
            </a>
          </li>
          <li>
            <!--<a href="{{ route('admin.vendedores') }}" class="nav-link {{ request()->routeIs('admin.vendedores') ? 'active' : '' }} py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Vendedores">
                <i class="bi bi-shop"></i>
            </a>-->
            <a href="{{ route('admin.pedidos') }}" class="nav-link {{ request()->routeIs('admin.pedidos') ? 'active' : '' }} py-3 border-bottom" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Vendedores">
                <i class="bi bi-shop"></i>
            </a>
          </li>
        </ul>
        <div class="dropdown border-top">
          <a href="#" class="d-flex align-items-center justify-content-center p-3 link-dark text-decoration-none dropdown-toggle" id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
          </a>
          <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser3">
            <li><a class="dropdown-item off" href="{{ route('admin.perfil') }}">Ver perfil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item btn-logout" href="#">Cerrar sesión <i class="bi bi-box-arrow-left"></i></a></li>
          </ul>
        </div>
    </div>
    <nav class="navbar" style="z-index: 2;">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Bienvenido {{ session('name') }} {{ session('lastName') }}</span>
        </div>
    </nav>
    
    
    <div class="container">
        <!--<div class="alert alert-success" role="alert" style="width: 400px; text-aling: center;">
            <center><i class="bi bi-check-circle"></i>     <span>     Se ha registrado un nuevo pedido</span> </center>
        </div>-->
        @yield('content')
    </div>
    
    <footer class="footer">
        <img src="{{ asset('resourses/iconpes.png') }}" alt="Icono" style="width: 40px; height: 40px;">
        <p>Mandaditos Xhate</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>